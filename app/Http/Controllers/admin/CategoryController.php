<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\genelNotify;
use Auth;
use App\Models\Category;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CategoryController extends Controller {

    public function __construct() {
        $this->middleware(['auth:admin', 'permission:category.list'], ['only' => 'index']);
        $this->middleware(['auth:admin', 'permission:category.delete'], ['only' => 'delete']);
        $this->middleware(['auth:admin', 'permission:category.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:category.create'], ['only' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $category = new Category;
        if ($request->id) {
            $category = $category->where(['category_id' => $request->id]);
            if (count($category->get()) < 1) {
                $response = ['type' => 'error', 'title' => 'Alt Kategori', 'message' => 'Görüntülenecek Altbaşlık Henüz Açılmamıştır'];
                return redirect()->back()->with($response);
            }
        } else {
            $category = $category->whereNull('category_id');
        }
        $category = $category->get();

        return view('admin.category.index', compact('category'));
    }

    public function recursive($kategori) {
        foreach ($kategori as $category) {
            echo $category->title . ' => <br/>';
            foreach ($category->sub_category as $sub) {
                echo str_repeat('&nbsp;', 10) . '' . $sub->title . '<br/>';
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $kategori = Category::tree()->get()->toTree();
        return view('admin.category.create', compact('kategori'));
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

        $create = Category::create([
                    'category_id' => $request->category_id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'slug' => $request->slug,
                    'icon' => $request->icon
        ]);

        $own = Auth::guard('admin')->user();

        $db_notif['admin'] = ['type' => 'category.create', 'message' => $own->username . ' yeni categori ekledi', 'ip' => $request->ip()];
        Notification::send($own, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'Yeni Kategori', 'message' => 'Ekleme Başarılı !'];
        return redirect(route('category.edit', $create->id))->with($response);
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
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
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
    public function delete($id, Request $request) {
        //
        $get = Category::findOrFail($id);
        $get->delete();
        $own = Auth::guard('admin')->user();

        $db_notif['admin'] = ['type' => 'category.delete', 'message' => $own->username . ' ' . $id . ' nolu kategoriyi sildi', 'ip' => $request->ip()];
        Notification::send($own, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'Kategori Silme', 'message' => 'Silme Başarılı !'];
        return redirect(route('category.index'))->with($response);
    }

}
