<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function indirimdekiler()
    {
        $turler=DB::select('SELECT * FROM turler ORDER BY adi');
        $urunler=DB::select('SELECT * FROM urunlers WHERE cevaplanma_durumu=1 and onaylanma_durumu = 1 and silinme_durumu =0 ORDER BY urun_adi');
        $yeniler=DB::select('SELECT * FROM turler ORDER BY adi');
        $popular=DB::select('SELECT * FROM turler ORDER BY adi');
        $data=DB::select('SELECT * FROM settings');
        $menu='indirimdekiler';
        return view("front.home",compact('turler','yeniler','popular','urunler','data','menu'));
    }

    public function hakkimizda()
    {
        $turler=DB::select('SELECT * FROM turler ORDER BY adi');
        $urunler=DB::select('SELECT * FROM urunlers WHERE cevaplanma_durumu=1 and onaylanma_durumu = 1 and silinme_durumu =0 ORDER BY urun_adi');
        $yeniler=DB::select('SELECT * FROM turler ORDER BY adi');
        $popular=DB::select('SELECT * FROM turler ORDER BY adi');
        $data=DB::select('SELECT * FROM settings');
        $menu='hakkimizda';
        return view("front.hakkimizda",compact('turler','yeniler','popular','urunler','data','menu'));
    }

    public function iletisim()
    {
        $turler=DB::select('SELECT * FROM turler ORDER BY adi');
        $data=DB::select('SELECT * FROM settings');
        $menu='iletisim';
        return view("front.iletisim",compact('turler','data','menu'));
    }

    public function index()
    {
        $turler=DB::select('SELECT * FROM turler ORDER BY adi');
        $urunler=DB::select('SELECT * FROM urunlers WHERE cevaplanma_durumu=1 and onaylanma_durumu = 1 and silinme_durumu =0 ORDER BY urun_adi');
        $popular=DB::select('SELECT * FROM urunlers WHERE cevaplanma_durumu=1 and onaylanma_durumu = 1 and silinme_durumu =0 ORDER BY satilan_adet desc');
        $yeniler=DB::select('SELECT * FROM turler ORDER BY adi');
        $data=DB::select('SELECT * FROM settings');
        $menu='anasayfa';
        return view("front.home",compact('turler','yeniler','popular','urunler','data','menu'));
    }

    public function urundetay($id)
    {
        $urun=DB::select('SELECT u.*,t.adi as turu FROM turler t,urunlers u WHERE u.tur_id=t.Id
                and u.cevaplanma_durumu = 1 and u.onaylanma_durumu = 1 and u.silinme_durumu=0 and u.Id=?',[$id]);
        $turler=DB::select('SELECT * FROM turler ORDER BY adi');
        $resimler=DB::select('SELECT * FROM images WHERE urun_id=?',[$id]);
        $data=DB::select('SELECT * FROM settings');
        $menu='urun';
        $yorumlar=DB::select('SELECT * FROM yorumlar WHERE urun_id=? ORDER BY tarih',[$id]);
        return view("front.urun_detay",compact('urun','turler','resimler','menu','data','yorumlar'));
    }

    public function bizeyazinform()
    {
        if(!Auth::check() || !Auth::user()->role=='musteri')
            return redirect('login')->with('message','Bize yazmak için giriş yapmalısınız.');
        $turler=DB::select('SELECT * FROM turler ORDER BY adi');
        $data=DB::select('SELECT * FROM settings');
        $menu='bizeyazin';
        return view("front.bizeyazin",compact('turler','data','menu'));
    }

    public function bizeyazinyolla(Request $request,$id)
    {
        DB::table('admin_messages')->insert([
            ['sender_id'=>$id,
                'subject'=>$request->get('konu'),
                'message'=>$request->get('mesaj')
            ]
        ]);
        return redirect('/bizeyazin')->with('success','Mesajınız iletildi.');
    }

    public function alinanmesajlar()
    {
        if(Auth::check())
        {
            if(Auth::user()->role='musteri')
            {
                $mesajlar=DB::select('SELECT * FROM messages m,users u WHERE m.Id=u.id and receiver_id=? ORDER BY tarih desc',[Auth::user()->id]);
                $data=DB::select('SELECT * FROM settings');
                $menu='alinanmesajlar';
                return view('front/alinanmesajlar',compact('mesajlar','data','menu'));
            }
        }
        else
            return redirect('/login')->with('message','Alınan mesajlarınıza ulaşmak için giriş yapmalısınız.');

    }

    public function gonderilenmesajlar()
    {
        if(Auth::check())
        {
            if (Auth::user()->role = 'musteri')
            {
                $admin_mesajlar = DB::select('SELECT * FROM admin_messages a WHERE sender_id=? ORDER BY a.tarih desc', [Auth::user()->id]);
                $mesajlar = DB::select('SELECT * FROM messages m,users u WHERE m.receiver_id=u.id and sender_id=? ORDER BY m.tarih desc', [Auth::user()->id]);
                $data = DB::select('SELECT * FROM settings');
                $menu = 'gonderilenmesajlar';
                return view('front/gonderilenmesajlar', compact('admin_mesajlar', 'mesajlar', 'data', 'menu'));
            }
        }
        return redirect('/login')->with('message','Gönderilen mesajlarınıza ulaşmak için giriş yapmalısınız.');
    }

    public function mesajcevaplamaform($id)
    {
        $data=DB::select('SELECT * FROM settings');
        $receiver=DB::select('SELECT * FROM users WHERE id=?',[$id]);
        $data=DB::select('SELECT * FROM settings');
        $menu='alinanmesajlar';
        return view("front/mesajcevaplama",compact('data','receiver','menu'));
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
        $data=DB::select('SELECT * FROM settings');
        $menu='alinanmesajlar';
        return redirect('gonderilenmesajlar')->with('success','Mesajınız iletildi.');
    }

    public function smesajcevaplamaform($id)
    {
        $data=DB::select('SELECT * FROM settings');
        $receiver=DB::select('SELECT * FROM users WHERE id=?',[$id]);
        $data=DB::select('SELECT * FROM settings');
        $menu='alinanmesajlar';
        return view("front/smesajcevaplama",compact('data','receiver','menu'));
    }

    public function smesajyolla(Request $request,$id,$id2)
    {
        DB::table('messages')->insert([
            ['sender_id'=>$id,
                'receiver_id'=>$id2,
                'subject'=>$request->get('konu'),
                'message'=>$request->get('mesaj')
            ]
        ]);
        $data=DB::select('SELECT * FROM settings');
        $menu='alinanmesajlar';
        return redirect('gonderilenmesajlar')->with('success','Mesajınız iletildi.');
    }

    public function tur($id)
    {
        $urunler=DB::select('SELECT * FROM urunlers WHERE cevaplanma_durumu=1 and onaylanma_durumu=1 and silinme_durumu=0 and tur_id=?',[$id]);
        $turler=DB::select('SELECT * FROM turler ORDER BY adi');
        $data=DB::select('SELECT * FROM settings');
        $menu='';
        return view('front/tur',compact('urunler','turler','data','menu'));
    }
}
