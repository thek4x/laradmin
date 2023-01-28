<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\genelNotify;
use Auth;
use App\Models\Category;
use App\Models\Slider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\page_forms;
class SliderController extends Controller {

    public function __construct() {
        $this->middleware(['auth:admin', 'permission:slider.list'], ['only' => 'index']);
        $this->middleware(['auth:admin', 'permission:slider.delete'], ['only' => 'destroy']);
        $this->middleware(['auth:admin', 'permission:slider.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:slider.create'], ['only' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $sliders = Slider::with('category')->get();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $kategori = Category::tree()->get()->toTree();
        return view('admin.slider.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate(['photo' => 'required|mimes:jpg,png,jpeg']);

        if ($request->has('photo')) {
            $newPN = hexdec(now()) . '_' . $request->photo->getClientOriginalName();
            $request->photo->move(public_path('uploads/slider/'), $newPN);
        }

        $slider = new Slider;
        $slider->title = $request->title;
        $slider->caption = $request->caption;
        $slider->category_id = $request->category_id;
        $slider->route = $request->route;
        $slider->photo = $newPN;
        $slider->save();

        $admin = Auth::guard('admin')->user();
        $db_notif['admin'] = ['type' => 'slider.create', 'message' => $admin->username . ' slider ekledi  ', 'ip' => $request->ip()];
        Notification::send($admin, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'Yeni Slider', 'message' => 'Slider Başarıyla Eklendi'];
        return redirect(route('slider.edit', $slider->id))->with($response);
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
    public function edit(Request $request, $id) {
        $kategori = Category::tree()->get()->toTree();
        $slider = Slider::findOrFail($id);
        $page_forms = page_forms::where('form_page', 'slider')->where('form_pageid', 0)->orWhere('form_pageid', $id)->get();
        return view('admin.slider.edit', compact('slider', 'kategori','page_forms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request->validate(['photo' => 'mimes:jpg,png,jpeg']);
        $slider = Slider::findOrFail($id);
        if ($request->has('photo')) {
            $newPN = hexdec(now()) . '_' . $request->photo->getClientOriginalName();
            $request->photo->move(public_path('uploads/slider/'), $newPN);
            $slider->photo = $newPN;
        }

        $slider->title = $request->title;
        $slider->caption = $request->caption;
        $slider->category_id = $request->category_id;
        $slider->route = $request->route;
        $slider->save();

        $admin = Auth::guard('admin')->user();
        $db_notif['admin'] = ['type' => 'slider.update', 'message' => $admin->username . ' slider güncellendi  ', 'ip' => $request->ip()];
        Notification::send($admin, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'Slider Güncelleme', 'message' => 'Slider Başarıyla Güncellendi'];
        return redirect(route('slider.edit', $id))->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $getSlider = Slider::findOrFail($id);
        $getSlider->delete();
        $admin = Auth::guard('admin')->user();
        $db_notif['admin'] = ['type' => 'slider.update', 'message' => $admin->username . ' slider sildi  ', 'ip' => $request->ip()];
        Notification::send($admin, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'Slider Güncelleme', 'message' => 'Slider Başarıyla Güncellendi'];
        return redirect(route('slider.index'))->with($response);
    }

}
