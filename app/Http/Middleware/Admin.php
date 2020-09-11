<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle($request, Closure $next)
    {
        if(Auth::check() && (Auth::user()->role == 'admin'))
        {
            return($next($request));
        }
        else
        {
            return redirect('/admin/login')->with('message','Login olmadan admin sayfasına giremezsiniz.');
        }
    }
}
