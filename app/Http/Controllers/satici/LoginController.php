<?php

namespace App\Http\Controllers\satici;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Satici;
use App\Http\Middleware\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function index()
    {
        return view("satici.login");
    }

    public function login(Request $request)
    {
        //echo Hash::make($request->password);
        if($request->isMethod('post'))
        {
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'role'=>'satici','active'=>'True']))
            {
                return redirect('/satici');
            }
            else
            {
                return redirect('/satici/login')->with('message','Hatalı Email yada Şifre');
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/satici/login')->with('message','Çıkış yapıldı.');
    }

    public function register_form()
    {
        return view("satici/register");
    }

    public function register_save(Request $request)
    {
        $kullanici=DB::select('SELECT count(*) as c FROM users WHERE email=?',[$request->get('email')]);
        if($kullanici[0]->c == 0)
        {
            if($request->hasfile('resim'))
            {
                $file=$request->file('resim');
                $name=time().$file->getClientOriginalName();
                $file->move(public_path().'/userfiles/',$name);
                DB::table('users')->insert([
                    ['name'=>$request->get('name'),
                        'email'=>$request->get('email'),
                        'password'=>Hash::make($request->get('password')),
                        'role'=>"satici",
                        'active'=>"True",
                        'resim'=>$name
                    ]
                ]);
            }
            else
            {
                DB::table('users')->insert([
                    ['name'=>$request->get('name'),
                        'email'=>$request->get('email'),
                        'password'=>Hash::make($request->get('password')),
                        'role'=>"satici",
                        'active'=>"True"
                    ]
                ]);
            }
            return redirect('/satici/login')->with('success','Kayıt oluşturuldu.');
        }
        else
            return redirect("satici/register")->with('message','Email adresi kullanımda');

    }
}
