<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\page_forms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\genelNotify;
use Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PageFormsController extends Controller {

    public function __construct() {
        $this->middleware(['auth:admin', 'permission:tables_form.list'], ['only' => 'index']);
        $this->middleware(['auth:admin', 'permission:tables_form.delete'], ['only' => 'delete']);
        $this->middleware(['auth:admin', 'permission:tables_form.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:tables_form.create'], ['only' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $list = page_forms::all();
        return view('admin.forms.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $group_name = Permission::distinct()->select('group_name')->get();
        return view('admin.forms.create', compact('group_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {


        $request->validate([
            'form_name' => 'required|string|unique:page_forms',
            'neweleman' => 'required|string',
            'form_page' => 'required'
            ],
            ['unique' => 'bu name kullanılmaktadır. başka name yazın']);
        $page_forms = page_forms::create([
                    'form_page' => $request->form_page,
                    'form_pageid' => $request->form_pageid,
                    'form_column' => $request->form_column,
                    'form_label' => $request->form_label,
                    'form_input' => $request->neweleman,
                    'form_name' => $request->form_name,
        ]);
        $own = Auth::guard('admin')->user();
        $db_notif['admin'] = ['type' => 'page_forms.create', 'message' => $own->username . ' ' . $page_forms->id . ' yi oluşturdu', 'ip' => $request->ip()];
        Notification::send($own, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'Form Page Eklemesi', 'message' => 'Ekleme Başarılı !'];
        return redirect(route('form_pages.edit', $page_forms->id))->with($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\page_forms  $page_forms
     * @return \Illuminate\Http\Response
     */
    public function show(page_forms $page_forms) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\page_forms  $page_forms
     * @return \Illuminate\Http\Response
     */
    public function edit(page_forms $page_forms, $id) {
        $group_name = Permission::distinct()->select('group_name')->get();
        $get_forms = page_forms::findOrFail($id);
        return view('admin.forms.edit', compact('get_forms', 'group_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\page_forms  $page_forms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, page_forms $page_forms, $id) {
        //
        $page_forms = page_forms::findOrFail($id);
        $page_forms->form_page = $request->form_page;
        $page_forms->form_column = $request->form_column;
        $page_forms->form_label = $request->form_label;
        $page_forms->form_input = $request->neweleman;
        $page_forms->form_name = $request->form_name;
        $page_forms->save();

        $own = Auth::guard('admin')->user();
        $db_notif['admin'] = ['type' => 'page_forms.update', 'message' => $own->username . ' ' . $id . ' de güncelleme yaptı', 'ip' => $request->ip()];
        Notification::send($own, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'Form Page Güncellemesi', 'message' => 'Güncelleme Başarılı !'];
        return redirect(route('form_pages.edit', $id))->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\page_forms  $page_forms
     * @return \Illuminate\Http\Response
     */
    public function destroy(page_forms $page_forms) {
        //
    }

    public function delete(page_forms $page_forms, $id, Request $request) {
        $page_forms = page_forms::findOrFail($id);
        $page_forms->delete();

        $own = Auth::guard('admin')->user();
        $db_notif['admin'] = ['type' => 'page_forms.delete', 'message' => $own->username . ' ' . $id . ' yi sildi', 'ip' => $request->ip()];
        Notification::send($own, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'Form Page Silme', 'message' => 'Silme Başarılı !'];
        return redirect(route('form_pages.index'))->with($response);
    }

    #name kısmını unique yap

    public function allPages(): array {
        return [
            'role' => ['roles', 'name'],
            'perm' => ['permissions', 'name'],
            'adminusers' => ['admins', 'name'],
            'info' => ['datatable', 'title'],
            'pages' => ['pages', 'title'],
            'ebulten' => ['ebulten', 'name'],
            'mail' => ['emails'],
            'category' => ['category', 'title'],
            'log' => ['notifications'],
            'slider' => ['sliders', 'title']
        ];
    }

    public function getSelectID(Request $request) {
        $allPages = config('form_tables');
        $table_name = $allPages[$request->table_name];
        if (count($table_name) == 2) {
            $table_rowname = $table_name[1];
            $select = "id, ($table_rowname) as baslik";
        } else {
            $select = ' id ';
        }
        $query = "select $select from $table_name[0]";
        $ids = DB::select($query);
        return response()->json($ids);
    }

    public function saveCreator(Request $request) {
        $hamdata = $request->except('_token', 'form_page');
        $page_forms = new page_forms;
        $own = Auth::guard('admin')->user();
        foreach ($hamdata as $hname => $hvalue) {
            if ($request->filled($hname)) {
                $page_forms->where('form_name', $hname)->update(['form_inputvalue' => $hvalue]);
            }
            $db_notif['admin'] = ['type' => 'page_forms.saveCreator', 'message' => $own->username . ' ' . $hname . ' in değerini güncelledi', 'ip' => $request->ip()];
            Notification::send($own, new genelNotify($db_notif));
        }

        $response = ['type' => 'success', 'title' => 'Page Form', 'message' => 'Veriler Başarıyla Eklendi!'];
        return redirect()->back()->with($response);
    }

}
