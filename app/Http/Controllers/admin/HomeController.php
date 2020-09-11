<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view("admin.home");
    }

    public function settings()
    {
        $site=DB::select('SELECT * FROM settings');
        return view("admin.settings",['site'=>$site]);
    }

    public function updatesettings(Request $request,$id)
    {
        DB::table('settings')->where('Id',$id)->update([
            'adi'=>$request->get('adi'),
            'keywords'=>$request->get('keywords'),
            'description'=>$request->get('description'),
            'adres'=>$request->get('tur_id'),
            'tel'=>$request->get('fiyat'),
            'smtpemail'=>$request->get('smtpemail')
        ]);
        return redirect('admin/ayarlar')->with('success','Ayarlar güncellendi.');
    }
    public function mesajyazform($id)
    {
        $data=DB::select('SELECT * FROM settings');
        $receiver=DB::select('SELECT * FROM users WHERE id=?',[$id]);
        return view("admin.mesajyazform",compact('data','receiver'));
    }

    public function mesajyolla(Request $request,$id,$id2)
    {
        DB::table('messages')->insert([
            ['sender_id'=>$id,
                'receiver_id'=>$id2,
                'subject'=>$request->get('konu'),
                'message'=>$request->get('mesaj')
            ]
        ]);
        return redirect('admin/gonderilenmesajlar')->with('success','Mesajınız iletildi.');
    }

    public function alinanmesajlar()
    {
        $mesajlar=DB::select('SELECT * FROM admin_messages a,users u WHERE a.sender_id=u.id ORDER BY a.tarih desc ');
        return view('admin/alinanmesajlar',compact('mesajlar'));
    }

    public function gonderilenmesajlar()
    {
        $mesajlar=DB::select('SELECT * FROM messages m,users u WHERE sender_id=? and u.id=m.receiver_id ORDER BY m.tarih desc ',[Auth::user()->id]);
        //$mesajlar=DB::select('SELECT * FROM messages WHERE sender_id=?',[Auth::user()->id]);
        return view('admin/gonderilenmesajlar',compact('mesajlar'));
    }

    public function mesajsil($id)
    {
        DB::table('admin_messages')->where('Id','=',$id)->delete();
        return redirect('admin/alinanmesajlar')->with('success','Mesaj silindi.');
    }
}
