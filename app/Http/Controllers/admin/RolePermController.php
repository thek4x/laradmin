<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\genelNotify;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\perm;

class RolePermController extends Controller {

    public $admin;

    public function __construct() {
        $this->middleware(['auth:admin', 'permission:role.list'], ['only' => 'role']);
        $this->middleware(['auth:admin', 'permission:role.edit'], ['only' => ['roledit', 'roleupdate']]);
        $this->middleware(['auth:admin', 'permission:role.create'], ['only' => ['permCreate', 'roleStore']]);
        $this->middleware(['auth:admin', 'permission:role.delete'], ['only' => ['roleDelete']]);
        $this->middleware(['auth:admin', 'permission:perm.list'], ['only' => ['perm']]);
        $this->middleware(['auth:admin', 'permission:perm.edit'], ['only' => ['roledit', 'roleupdate']]);
    }

    public function admin() {
        return $this->admin = Auth::guard('admin')->user();
    }

    public function role() {
        $user_id = $this->admin()->id;
        $admin = Admin::findOrFail($user_id);
        $all_role = Role::whereNull('deleted_at')->get();

        return view('admin.roleperm.role', compact('all_role'));
    }

    public function roleCreate() {
        $perms = Permission::all();
        return view('admin.roleperm.roleCreate', compact('perms'));
    }

    public function roleStore(Request $request) {
        $req_role = $request->role;
        $request->validate(['role' => 'required', 'permission' => 'required'], ['role.required' => 'role alanı zorunludur', 'permission.required' => 'perm seçmek zorunludur']);

        $role = Role::create(['name' => $req_role, 'guard_name' => 'admin']);
        $admin = $this->admin();

        foreach ($request->permission as $perm) {
            $role->givePermissionTo($perm);
        }
        $db_notif['admin'] = ['type' => 'rolecreate', 'message' => $admin->username . ' yeni rol ekledi', 'ip' => $request->ip()];
        Notification::send($admin, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'Rol Ekleme', 'message' => 'Yeni Rol başarıyla eklendi'];
        return redirect()->intended('admin/role')->with($response);
    }

    public function roledit($id) {
        $perms = Permission::all();
        $role = Role::findOrFail($id);
        $getroleperm = $role->permissions->pluck('name');
        return view('admin.roleperm.roleEdit', compact('role', 'perms', 'getroleperm'));
    }

    public function roleupdate(Request $request, $id) {
        $request->validate(['role' => 'required']);
        $getRole = Role::findOrFail($id);
        $getRole->name = $request->role;
        $getRole->updated_at = now();
        $getRole->save();
        $getRole->syncPermissions($request->permission);

        $admin = $this->admin();

        $db_notif['admin'] = ['type' => 'roleupdate', 'message' => $admin->username .' '. $request->role . ' rolunu güncelledi', 'ip' => $request->ip()];
        Notification::send($admin, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'Rol Düzenleme', 'message' => 'Rol başarıyla düzenlendi'];
        return redirect()->back()->with($response);
    }

    public function roleDelete($id, Request $request) {

        $role = Role::findOrFail($id);
        $role->deleted_at = DB::raw('NOW()');
        $role->save();

        $admin = $this->admin();
        $db_notif['admin'] = ['type' => 'roledelete', 'message' => $admin->username .' '. $role->name . ' role silindi ', 'ip' => $request->ip()];
        Notification::send($admin, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'Rol Silme', 'message' => 'Rol başarıyla silindi'];
        return redirect()->back()->with($response);
    }

    public function permCreate() {
        
    }

    public function perm() {
        $all_admin = Admin::all();
        return view('admin.roleperm.perm', compact('all_admin'));
    }

    public function permAdd($id) {
        $admin = Admin::findOrFail($id);
        $perms = Permission::all();
        $all_role = Role::all();
        $getroleperm = $admin->permissions->pluck('name');

//        $test = collect($admin->roles->pluck('name'));
        return view('admin.roleperm.permAdd', compact('admin', 'perms', 'getroleperm', 'all_role'));
    }

    public function permUpdate($id, Request $request) {
        $admin = $this->admin();
        $user = Admin::findOrFail($id);
        $roles = $request->roles;
        $permission = $request->permission;

        $user->syncRoles($roles);
        $user->syncPermissions($permission);

        $db_notif['admin'] = ['type' => 'permAdded', 'message' => $admin->username .' '. $user->username . ' permitasyonlarını güncelledi', 'ip' => $request->ip()];
        Notification::send($admin, new genelNotify($db_notif));

        $response = ['type' => 'success', 'title' => 'Permtasyon Güncelleme', 'message' => 'Permler başarıyla Eklendi'];
        return redirect()->back()->with($response);
    }

}
