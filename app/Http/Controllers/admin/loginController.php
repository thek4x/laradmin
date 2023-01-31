<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\adminLogin;
use Illuminate\Support\Facades\Auth;

use App\Models\Admin;

class loginController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.login.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(adminLogin $request) {
        $check = $request->all();
        if (Auth::guard('admin')->attempt(['username' => $check['username'], 'password' => $check['password']])) {

            $admin = Auth::guard('admin')->user();
            #notification'a bu durumu logla
            $db_notif['admin'] = ['type' => 'adminlogin', 'message' => $admin->username . ' giris yaptı', 'ip' => $request->ip()];
            Notification::send($admin, new genelNotify($db_notif));

            $response = ['type' => 'success', 'title' => 'Giriş Başarılı', 'message' => 'Panele giriş yapıldı'];
            return redirect()->route('admin.admins.index')->with($response);
        } else {
            $response = ['type' => 'error', 'title' => 'Giriş Başarısız', 'message' => 'Lütfen tekrar deneyiniz'];
            return redirect()->intended('admin')->with($response);
        }
    }

    public function list() {



        return view('admin.user.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
