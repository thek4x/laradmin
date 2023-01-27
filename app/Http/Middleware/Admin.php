<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Admin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        if (!Auth::guard('admin')->check()) {
            $response = ['type' => 'error', 'title' => 'Giriş Başarısız', 'message' => 'Lütfen tekrar deneyiniz'];
//            return redirect()->route('admin.login')->with($response);
            return redirect()->route('admin.login');
        }
        return $next($request);
    }

}
