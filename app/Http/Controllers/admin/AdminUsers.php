<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Notifications\genelNotify;
use Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\page_forms;

class AdminUsers extends Controller {

    public function __construct() {
        $this->middleware(['auth:admin', 'permission:adminusers.list'], ['only' => 'index']);
        $this->middleware(['auth:admin', 'permission:adminusers.delete'], ['only' => 'delete']);
        $this->middleware(['auth:admin', 'permission:adminusers.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:adminusers.create'], ['only' => ['create']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {


        $users = Admin::all();
        return view('admin.admins.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'adsoyad' => 'required',
            'username' => 'required|unique:admins',
            'email' => 'required|email|unique:admins',
            'password' => 'required|'
        ]);

        Admin::create([
            'name' => $request->adsoyad,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $own = Auth::guard('admin')->user();

        $db_notif['admin'] = ['type' => 'adminusers.create', 'message' => $own->username . ' ' . $request->username . ' isimli yöneticiyi ekledi', 'ip' => $request->ip()];
        Notification::send($own, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'Admin Users Create', 'message' => 'Ekleme Başarılı !'];
        return redirect()->back()->with($response);
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
        $page_forms = page_forms::where('form_page', 'adminusers')->where('form_pageid', 0)->orWhere('form_pageid', $id)->get();
        $user = Admin::findOrFail($id);
        return view('admin.admins.edit', compact('user', 'page_forms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email'
        ]);
        $admin = Admin::findOrFail($id);
        if (isset($request->password)) {
            $admin->password = Hash::make($request->password);
        }
        $admin->username = $request->username;
        $admin->email = $request->email;
        #loglama

        $own = Auth::guard('admin')->user();

        $db_notif['admin'] = ['type' => 'adminusers.update', 'message' => $own->username . ' ' . $admin->username . ' bilgilerinde güncelleme yaptı', 'ip' => $request->ip()];
        Notification::send($own, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'Admin Users Update', 'message' => 'Güncelleme Başarılı !'];
        return redirect()->back()->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id, Request $request) {
        $admin = Admin::findOrFail($id);
        $admin->deleted_at = now();
        $admin->save();

        $own = Auth::guard('admin')->user();

        $db_notif['admin'] = ['type' => 'adminusers.update', 'message' => $own->username . ' ' . $admin->username . ' kullanıcısını sildi', 'ip' => $request->ip()];
        Notification::send($admin, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'Admin Users Delete', 'message' => 'Silme Başarılı !'];
        return redirect()->back()->with($response);
    }

}
