<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Satici
{
    public function handle($request, Closure $next)
    {
        if(Auth::check() && (Auth::user()->role == 'satici'))
        {
            return($next($request));
        }
        else
        {
            return redirect('/satici/login')->with('message','Login olmadan satici sayfasına giremezsiniz.');
        }
    }
}
