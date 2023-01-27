<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PagesModel;
use App\Models\Category;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Notification;
use App\Notifications\genelNotify;
use Auth;
use App\Models\page_forms;

class PagesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware(['auth:admin', 'permission:pages.list'], ['only' => 'index']);
        $this->middleware(['auth:admin', 'permission:pages.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:pages.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:pages.delete'], ['only' => ['delete']]);
    }

    public function index() {
        $pages = PagesModel::all();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
//        $categorys = PagesModel::distinct()->whereNotNull('category')->get('category');
        $categorys = Category::select('id', 'title')->get();
        $page_forms = page_forms::where('form_page', 'pages')->get();
        return view('admin.pages.create', compact('categorys', 'page_forms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $request->validate([
            'title' => 'required'
        ]);

        $pages = new PagesModel;
        $pages->slug = $request->slug;
        $pages->title = $request->title;
        $pages->content = $request->content;
        $pages->category = $request->category;
        $pages->page_title = $request->page_title;
        $pages->page_description = $request->page_description;
        $pages->page_keywords = $request->page_keyword;
        $pages->ip = $request->ip();

        $pages->save();

        $auth = Auth::guard('admin')->user();
        $db_notif['admin'] = ['type' => 'pages.create', 'message' => $auth->username . ' sayfa ekledi ', 'ip' => $request->ip()];
        Notification::send($auth, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'Yeni Sayfa', 'message' => 'Sayfa Başarıyla Eklendi'];
        return redirect(route('pages.edit', $pages->id()))->with($response);
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
        $categorys = Category::select('id', 'title')->get();
        $result = PagesModel::findOrFail($id)->first();
        $page_forms = page_forms::where('form_page', 'pages')->get();
        return view('admin.pages.edit', compact('categorys', 'result', 'page_forms'));
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
            'title' => 'required'
        ]);

        $pages = PagesModel::findOrFail($id);
        $pages->slug = $request->slug;
        $pages->title = $request->title;
        $pages->content = $request->content;
        $pages->category = $request->category;
        $pages->page_title = $request->page_title;
        $pages->page_description = $request->page_description;
        $pages->page_keywords = $request->page_keyword;
        $pages->ip = $request->ip();

        $pages->save();

        $auth = Auth::guard('admin')->user();
        $db_notif['admin'] = ['type' => 'pages.update', 'message' => $auth->username . ' sayfayı güncelledi ', 'ip' => $request->ip()];
        Notification::send($auth, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'Sayfa Güncellemesi', 'message' => 'Sayfa Başarıyla Güncellendi'];
        return redirect()->back()->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id, Request $request) {
        $pages = PagesModel::findOrFail($id);
        $pages->delete();
        $auth = Auth::guard('admin')->user();
        $db_notif['admin'] = ['type' => 'pages.delete', 'message' => $auth->username . ' sayfayı sildi ', 'ip' => $request->ip()];
        Notification::send($auth, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'Sayfa Silme', 'message' => 'Sayfa Başarıyla Silindi'];
        return redirect()->back()->with($response);
    }

}
