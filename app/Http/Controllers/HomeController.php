<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Pinjam;
use App\Models\AsetReview;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        $pinjams = Pinjam::with('user')
            ->where('user_id', auth()->user()->id)
            ->paginate(10);

        return view('user.index')->with('pinjams', $pinjams);
    }

    public function profile()
    {
        $profile = Auth()->user();
        // return $profile;
        return view('user.users.profile')->with('profile', $profile);
    }

    public function profileUpdate(Request $request, $id)
    {
        // return $request->all();
        $user = User::findOrFail($id);
        $data = $request->all();
        $status = $user->fill($data)->save();
        if ($status) {
            session()->flash('success', 'Successfully updated your profile');
        } else {
            session()->flash('error', 'Please try again!');
        }
        return redirect()->back();
    }

    // pinjam
    public function pinjamIndex()
    {
        $pinjams = Pinjam::orderBy('id', 'DESC')->where('user_id', auth()->user()->id)->paginate(10);
        return view('user.pinjam.index')->with('pinjams', $pinjams);
    }
    public function userpinjamDelete($id)
    {
        $pinjam = Pinjam::find($id);
        if ($pinjam) {
            if ($pinjam->status == "process" || $pinjam->status == 'delivered' || $pinjam->status == 'cancel') {
                return redirect()->back()->with('error', 'You can not delete this pinjam now');
            } else {
                $status = $pinjam->delete();
                if ($status) {
                    session()->flash('success', 'Pinjam Successfully deleted');
                } else {
                    session()->flash('error', 'Pinjam can not deleted');
                }
                return redirect()->route('user.pinjam.index');
            }
        } else {
            session()->flash('error', 'Pinjam can not found');
            return redirect()->back();
        }
    }

    public function pinjamShow($id)
    {
        $pinjam = Pinjam::find($id);
        // return $pinjam;
        return view('user.pinjam.show')->with('pinjam', $pinjam);
    }
    // Aset Review
    public function asetReviewIndex()
    {
        $reviews = AsetReview::getAllUserReview();
        return view('user.review.index')->with('reviews', $reviews);
    }

    public function asetReviewEdit($id)
    {
        $review = AsetReview::find($id);
        // return $review;
        return view('user.review.edit')->with('review', $review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function asetReviewUpdate(Request $request, $id)
    {
        $review = AsetReview::find($id);
        if ($review) {
            $data = $request->all();
            $status = $review->fill($data)->update();
            if ($status) {
                session()->flash('success', 'Review Successfully updated');
            } else {
                session()->flash('error', 'Something went wrong! Please try again!!');
            }
        } else {
            session()->flash('error', 'Review not found!!');
        }

        $previousUrl = url()->previous();

        return redirect($previousUrl)->withInput()->with('previousUrl', $previousUrl);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function asetReviewDelete($id)
    {
        $review = AsetReview::find($id);
        $status = $review->delete();
        if ($status) {
            session()->flash('success', 'Successfully deleted review');
        } else {
            session()->flash('error', 'Something went wrong! Try again');
        }
        return redirect()->route('user.asetreview.index');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function changePassword()
    {
        return view('user.layouts.userPasswordChange');
    }
    public function changPasswordStore(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('user')->with('success', 'Password successfully changed');
    }
}
