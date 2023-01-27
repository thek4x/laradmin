<?php

use Illuminate\Support\Str;

function is_active($url, $className = 'active') {
    return request()->is($url) ? $className : null;
}

function can($permitasyon) {
    $explode = explode('|', $permitasyon);
    if (count($explode) == 1) {
        if (!Auth::guard('admin')->user()->can($permitasyon))
            return false;
        else
            return true;
    } else {
        foreach ($explode as $perms) {
            if (!Auth::guard('admin')->user()->can($perms))
                return false;
            else
                return true;
        }
    }

    return true;
}

function recursive($cat) {
    foreach ($cat as $subchildren) {
        dd($subchildren);
    }
}
