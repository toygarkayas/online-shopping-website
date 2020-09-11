<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Admin;
use App\Http\Middleware\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function index()
    {
        return view("admin.login");
    }

    public function login(Request $request)
    {
        //echo Hash::make($request->password);
        if($request->isMethod('post'))
        {
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'role'=>'admin','active'=>'True']))
            {
                return redirect('/admin');
            }
            else
            {
                return redirect('/admin/login')->with('message','Hatalı Email yada Şifre');
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login')->with('message','Çıkış yapıldı.');
    }
}
