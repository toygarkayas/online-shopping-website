<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login_form()
    {
        $data=DB::select('SELECT * FROM settings');
        $menu='uye';
        return view('front.login',compact('data','menu'));
    }

    public function login(Request $request)
    {
        //echo Hash::make($request->password);
        if($request->isMethod('post'))
        {
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'role'=>'musteri','active'=>'True']))
            {
                return redirect('/user');
            }
            else
            {
                return redirect('/login')->with('message','Hatalı Email yada Şifre');
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('message','Çıkış yapıldı.');
    }

    public function register_form()
    {
        return view("front/register_form");
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
                        'role'=>"musteri",
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
                        'role'=>"musteri",
                        'active'=>"True"
                    ]
                ]);
            }
            return redirect('/login')->with('success','Kayıt oluşturuldu.');
        }
        else
            return redirect('/register')->with('message','Email kayıtlı.');
    }
}
