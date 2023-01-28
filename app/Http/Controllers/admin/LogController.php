<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\genelNotify;
Use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Cache;

class LogController extends Controller {

    public function __construct() {
        $this->middleware(['auth:admin', 'permission:log.list'], ['only' => 'index']);
    }

    public function index() {
        
        $users = Cache::remember('users','8640' , function () {            
                    return Admin::all();
        });

        return view('admin.log.index', compact('users'));
    }

}
