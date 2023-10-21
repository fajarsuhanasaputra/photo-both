<?php

namespace App\Http\Controllers\Admin\Accont;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function my_profile() {
        $user = User::where('id', Auth::user()->id)->get();
        $view['user'] = $user;

        return view('backend.menu.account.profile', $view);
    }

    public function update_profile(Request $request, $id) {
        User::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        alert()->success('Data Berhasil diubah', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return back()->withInfo(['status' => 'Profile updated successfully.']);;
    }

    public function change_password() {
        return view('backend.menu.account.change-password');
    }

    public function update_password(Request $request) {
        $request->validate([
            'old_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => bcrypt($request->new_password)]);
        alert()->success('Ubah Password Berhasil', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return back();
    }

}
