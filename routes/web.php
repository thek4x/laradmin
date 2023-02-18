<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\loginController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\RolePermController;
use App\Http\Controllers\admin\AdminUsers;
use App\Http\Controllers\admin\LogController;
use App\Http\Controllers\admin\dataTable;
use App\Http\Controllers\CacheController;
use App\Http\Controllers\admin\PagesController;
use App\Http\Controllers\admin\FileMController;
use App\Http\Controllers\admin\MailController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\PageFormsController;
use App\Http\Controllers\admin\UserController;
use App\Http\Middleware\Admin;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */



Route::get('caches', [CacheController::class, 'index'])->name('cache');
//Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['admin', 'guest']], function (){
//    \UniSharp\LaravelFilemanager\Lfm::routes();
//});
require __DIR__ . '/auth.php';

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    #login
    Route::get('/', [LoginController::class, 'index'])->name('admin.login')->withoutMiddleware([Admin::class]);
    Route::post('store', [LoginController::class, 'store'])->name('admin.login.store')->withoutMiddleware([Admin::class]);
    #profile
    Route::get('admins', [LoginController::class, 'list'])->name('admin.admins.index');
    Route::get('profile', [ProfileController::class, 'getUser'])->name('admin.profile');
    Route::post('profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::get('profile/logout', [ProfileController::class, 'logout'])->name('admin.profile.logout')->withoutMiddleware([Admin::class]);
    #role
    Route::get('role', [RolePermController::class, 'role'])->name('admin.rolelist');
    Route::get('role/create', [RolePermController::class, 'roleCreate'])->name('admin.rolecreate');
    Route::post('role/store', [RolePermController::class, 'roleStore'])->name('admin.roleStore');
    Route::get('role/{id}/edit', [RolePermController::class, 'roledit'])->name('admin.roledit');
    Route::post('role/{id}/update', [RolePermController::class, 'roleupdate'])->name('admin.roleupdate');
    Route::get('role/{id}/delete', [RolePermController::class, 'roledelete'])->name('admin.roledelete');
    #permission
    Route::get('permission/permadd/{id}', [RolePermController::class, 'permAdd'])->name('admin.permadd');
    Route::get('permission/', [RolePermController::class, 'perm'])->name('admin.permlist');
    Route::post('permission/permUpdate/{id}', [RolePermController::class, 'permUpdate'])->name('admin.permUpdate');
    #test
    Route::get('test', [ProfileController::class, 'test'])->name('admin.test');
    #admins
    Route::resource('adminusers', AdminUsers::class)->except('destroy');
    Route::get('adminusers/{id}/delete', [AdminUsers::class, 'delete'])->name('adminusers.delete');
    #notification
    Route::get('notifications', [LogController::class, 'index'])->name('admin.logs');
    #info - datatable
    Route::get('info/{id}/delete', [dataTable::class, 'delete'])->name('info.delete');
    Route::resource('info', dataTable::class)->except('destroy');
//    Route::post('info',[dataTable::class,'index']);
    #pages
    Route::resource('pages', pagesController::class)->except('destroy');
    Route::get('pages/{id}/delete', [PagesController::class, 'delete'])->name('pages.delete');
    #filemanager
    Route::get('filemanager', [FileMController::class, 'index'])->name('admin.filemanager');
    #mail - ebülten
    Route::resource('mail', MailController::class)->except('destroy');
    Route::get('ebulten', [MailController::class, 'ebulten'])->name('ebulten.list');
    #category
    Route::resource('category', CategoryController::class)->except('destroy');
    Route::get('category/{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');
    #slider
    Route::resource('slider', SliderController::class)->except('destroy');
    Route::get('slider/{id}/delete', [SliderController::class, 'destroy'])->name('slider.delete');
    #form_pages
    Route::resource('form_pages', PageFormsController::class)->except('destroy');
    Route::get('form_pages/{page_forms}/delete', [PageFormsController::class, 'delete'])->name('form_pages.delete');
    Route::post('form_pages/getSelectID', [PageFormsController::class, 'getSelectID'])->name('form_pages.getid');
    Route::post('form_pages/saveCreator', [PageFormsController::class, 'saveCreator'])->name('form_pages.save');
    #users
    Route::resource('users', UserController::class)->except('destroy');
    Route::get('users/{id}/delete', [UserController::class, 'delete'])->name('users.delete');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

