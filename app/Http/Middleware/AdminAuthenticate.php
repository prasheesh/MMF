<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminAuthenticate
{
    public function handle(Request $request, Closure $next){
        if(Auth::guard('admin')->check() && Auth::guard('admin')->user()){
            return $next($request);
        }else{
            Auth::guard('admin')->logout();
            return redirect()->route('login');
        }
    }
}
