<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Maintenance;
use App\Models\Aset;
use Carbon\Carbon;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maintenances = Aset::getAllAset();
        return view('backend.maintenance.index')->with('maintenances', $maintenances);
    }

    public function create()
    {
        $asets = Aset::all();
        return view('backend.maintenance.create')->with('asets', $asets);
    }

    public function store(Request $request)
    {
        // Proses penyimpanan fungsi baru dari formulir
    }

    public function show($id)
{
    // Mengambil aset berdasarkan id yang diberikan
    $maintenances = Aset::find($id);
    return view('backend.maintenance.show', compact('maintenances'));
}




    public function edit($id)
    {
        $maintenances = Maintenance::findOrFail($id);
        $asets = Aset::all();
        return view('backend.maintenance.edit', compact('maintenances', 'asets'));
    }

    public function update(Request $request, $id)
    {
        // Proses penyuntingan fungsi berdasarkan formulir
    }

    public function destroy($id)
    {
        $delete = Maintenance::findorFail($id);
        $status = $delete->delete();
        if ($status) {
            session()->flash('success', 'maintenance Berhasil Dihapus');
        } else {
            session()->flash('error', 'Gagal Dihapus, Terjadi Kesalahan');
        }
        return redirect()->route('maintenances.index');
    }
}
