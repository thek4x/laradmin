<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Notifications\genelNotify;
use App\Models\User;

class ProfileController extends Controller {

    public $admin = '';

    public function __construct() {
        
    }

    public function admin() {
        return $this->admin = Auth::guard('admin')->user();
    }

    public function getUser() {
        $user = Admin::findOrFail($this->admin()->id);
        return view('admin.profile.list', compact('user'));
    }

    public function update(Request $request) {
        $request->validate([
            'username' => 'required|max:50',
            'email' => 'required|email',
        ]);
        $admin = Admin::findOrFail($this->admin()->id);
        if (isset($request->password)) {
            $admin->password = Hash::make($request->password);
        }
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->save();

        #loglama
        $db_notif['admin'] = ['type' => 'adminprofileupdate', 'message' => $admin->username . ' profilinde güncelleme yaptı', 'ip' => $request->ip()];
        Notification::send($admin, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'Profil Güncelleme', 'message' => 'Güncelleme Başarılı !'];
        return redirect()->route('admin.profile')->with($response);
    }

    public function test(Request $request) {
        $users = User::query();
        
        $result = $users->when($request->verify == 1, function ($users) {
            $users->whereNotNull('email_verified_at');
        });
        
        $result = $result->get();
        dd($result);
    }

    public function logout(Request $request) {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin');
    }

}
