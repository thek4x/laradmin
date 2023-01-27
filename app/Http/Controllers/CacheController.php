<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Models\Admin;
use App\Models\Notify;

class CacheController extends Controller {

    //

    public function index() {
        $user = Notify::all();
        foreach ($user as $id => $res) {
            Redis::hmset('notify', "$id", $res);
        }
    }

}
