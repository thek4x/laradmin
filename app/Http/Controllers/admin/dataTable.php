<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\dataTable as dbtable;
use App\Models\Admin;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use App\Notifications\genelNotify;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class dataTable extends Controller {

    public function __construct() {
        $this->middleware(['auth:admin', 'permission:info.list'], ['only' => 'index']);
        $this->middleware(['auth:admin', 'permission:info.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:info.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:info.delete'], ['only' => ['delete']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
//        if ($request->filled('search')) {
//            $list = dbtable::search($request->search)->get();
//        } else {
//            $list = dbtable::all();
//        }
        $list = dbtable::with('admins')->get();
        return view('admin.datatable.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.datatable.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'type' => 'required',
            'category' => 'string',
            'data' => 'required'
        ]);

        $auth = Auth::guard('admin')->user();
        $datatable = new dbtable;
        $datatable->admins_id = $auth->id;
        $datatable->type = $request->type;
        $datatable->category = $request->category;
        $datatable->key = $request->key;
        $datatable->title = $request->title;
        $datatable->data = $request->data;
        $datatable->route = $request->route;
        $datatable->save();

        $db_notif['admin'] = ['type' => 'info.create', 'message' => $auth->username . ' ekleme yaptı', 'ip' => $request->ip()];
        Notification::send($auth, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'Yeni İnfo', 'message' => 'İnfo Başarıyla Eklendi'];
        return redirect()->back()->with($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $info = dbTable::findOrFail($id)->with('admins')->first();
        return view('admin.datatable.edit', compact('info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $datatable = dbTable::findOrFail($id);
        $request->validate([
            'type' => 'required',
            'category' => 'string',
            'data' => 'required'
        ]);

        $auth = Auth::guard('admin')->user();
        $datatable->admins_id = $auth->id;
        $datatable->type = $request->type;
        $datatable->category = $request->category;
        $datatable->key = $request->key;
        $datatable->title = $request->title;
        $datatable->data = $request->data;
        $datatable->route = $request->route;
        $datatable->save();

        $db_notif['admin'] = ['type' => 'info.update', 'message' => $auth->username . ' ' . $id . ' nolu infoyu güncellendi', 'ip' => $request->ip()];
        Notification::send($auth, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'İnfo Güncelleme', 'message' => 'Güncelleme Başarılı'];
        return redirect()->back()->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id, Request $request) {
        //
        $auth = Auth::guard('admin')->user();
        $datatable = dbTable::findOrFail($id);
        $datatable->delete();
        $db_notif['admin'] = ['type' => 'info.delete', 'message' => $auth->username . ' ' . $id . ' nolu infoyu sildi', 'ip' => $request->ip()];
        Notification::send($auth, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'İnfo Delete', 'message' => 'Silme Başarılı'];
        return redirect()->back()->with($response);
    }

}
