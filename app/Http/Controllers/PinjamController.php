<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Pinjam;
use App\Models\AsetReview;
use App\User;
use Helper;
use Illuminate\Support\Facades\PDF;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use App\Notifications\StatusNotification;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pinjams = Pinjam::orderBy('id', 'DESC')->paginate(10);
        return view('backend.pinjam.index')->with('pinjams', $pinjams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. Cek Data Cart
        $cartItems = Cart::where('user_id', auth()->user()->id)
            ->where('pinjam_id', null)
            ->get();

        if ($cartItems->isEmpty()) {
            session()->flash('error', 'Keranjang Belanja Kosong!');
            return back();
        }

        // 2. Membuat array kosong untuk menyimpan entri pinjam yang akan dibuat
        $pinjamEntries = [];

        foreach ($cartItems as $cartItem) {
            // 3. Menyiapkan data pinjam untuk setiap aset dalam keranjang
            $pinjamEntry = [
                'pinjam_number' => 'ASET-' . strtoupper(Str::random(10)),
                'user_id' => $request->user()->id,
                'aset_id' => $cartItem->aset->id,
                'quantity' => $cartItem->quantity,
                'status' => "Baru",
                'rv' => "Baru",
                'created_at' => now(), // Tambahkan waktu pembuatan
                'updated_at' => now(), // Tambahkan waktu pembaruan
            ];

            // 4. Menambahkan data pinjam ke dalam array pinjamEntries
            $pinjamEntries[] = $pinjamEntry;
        }

        // 5. Menyimpan semua entri pinjam ke dalam database
        $status = Pinjam::insert($pinjamEntries);

        if ($status) {
            // 6. Mengirim notifikasi ke admin (jika perlu)

            // 7. Memperbarui cart untuk menandai aset sudah dipinjam
            Cart::where('user_id', auth()->user()->id)
                ->where('pinjam_id', null)
                ->update(['pinjam_id' => null]); // Memperbarui pinjam_id menjadi null, karena aset telah dipinjam

            session()->flash('success', 'Aset berhasil ditempatkan dalam pinjam!');
            return redirect()->route('home');
        } else {
            session()->flash('error', 'Gagal membuat pinjam. Silakan coba lagi.');
            return back();
        }
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Ambil data peminjaman berdasarkan pinjamId
        $pinjam = Pinjam::findOrFail($id);

        // Kirim data pinjam dan reviews ke view
        return view('backend.pinjam.show', compact('pinjam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pinjam = Pinjam::find($id);
        return view('backend.pinjam.edit')->with('pinjam', $pinjam);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pinjam = Pinjam::find($id);

        if (!$pinjam) {
            // Handle if Pinjam not found
            return redirect()->route('pinjam.index')->with('error', 'Pinjam not found');
        }

        $this->validate($request, [
            'status' => 'required|in:Baru,Diproses,Siap Diambil,Dibatalkan,Dikembalikan',
        ]);

        $data = $request->only('status');

        if ($request->status == 'Siap Diambil') {
            foreach ($pinjam->cart as $cart) {
                $aset = $cart->aset;
                $aset->stock -= $cart->quantity;
                $aset->save();
            }
        }

        $status = $pinjam->update($data);

        if ($status) {
            session()->flash('success', 'Successfully updated Pinjam');
        } else {
            session()->flash('error', 'Error while updating Pinjam');
        }

        return redirect()->route('pinjam.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pinjam = Pinjam::find($id);
        if ($pinjam) {
            $status = $pinjam->delete();
            if ($status) {
                session()->flash('success', 'Pinjam Successfully deleted');
            } else {
                session()->flash('error', 'Pinjam can not deleted');
            }
            return redirect()->route('pinjam.index');
        } else {
            session()->flash('error', 'Pinjam can not found');
            return redirect()->back();
        }
    }

    public function return($id)
    {
        $pinjam = Pinjam::findOrFail($id);

        // Logika pengembalian pinjaman disini...

        $pinjam->status = 'Dikembalikan';
        $pinjam->quantity = '1';
        $pinjam->save();

        if ($pinjam->status == 'Dikembalikan') {
            foreach ($pinjam->cart as $cart) {
                $aset = $cart->aset;
                $aset->stock += $cart->quantity;
                $aset->save();
            }
        }

        session()->flash('success', 'Pinjaman berhasil dikembalikan');
        return redirect()->back();
    }


    public function pinjamTrack()
    {
        return view('frontend.pages.pinjamanku');
    }

    public function asetTrackPinjam(Request $request)
    {
        // return $request->all();
        $pinjam = Pinjam::where('user_id', auth()->user()->id)->where('pinjam_number', $request->pinjam_number)->first();
        if ($pinjam) {
            if ($pinjam->status == "new") {
                session()->flash('success', 'Your Pinjam has been placed. please wait.');
                return redirect()->route('home');
            } elseif ($pinjam->status == "process") {
                session()->flash('success', 'Your Pinjam is under processing please wait.');
                return redirect()->route('home');
            } elseif ($pinjam->status == "delivered") {
                session()->flash('success', 'Your Pinjam is successfully delivered.');
                return redirect()->route('home');
            } else {
                session()->flash('error', 'Your Pinjam canceled. please try again');
                return redirect()->route('home');
            }
        } else {
            session()->flash('error', 'Invalid Pinjam numer please try again');
            return back();
        }
    }
}
