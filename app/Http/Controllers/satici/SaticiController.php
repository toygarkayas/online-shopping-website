<?php

namespace App\Http\Controllers\satici;

use App\Http\Controllers\Controller;
use App\Urunler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaticiController extends Controller
{
    public function __construct()
    {
        $this->middleware('satici');
    }

    public function index()
    {
        $istekler=DB::select('SELECT i.Id,t.adi as tur,i.urun_adi,i.fiyat,i.keywords,i.description,i.stok,i.cevaplanma_durumu,i.onaylanma_durumu,i.resim,u.email as email FROM urunlers i,turler t,users u WHERE t.Id=i.tur_id and silinme_durumu=0 and i.satici_id=u.id ORDER BY id');
        return view('satici.satistaki_urunler',['istekler'=>$istekler]);
    }
    public  function istekler()
    {
        $istekler=DB::select('SELECT i.Id,t.adi as tur,i.urun_adi,i.fiyat,i.stok,i.cevaplanma_durumu,i.onaylanma_durumu,i.resim,u.email as email FROM urunlers i,turler t,users u WHERE t.Id=i.tur_id and silinme_durumu=0 and i.satici_id=u.id ORDER BY id');//WHERE SATICI_ID = SATICIMIZ
        return view('satici.istekler',['istekler'=>$istekler]);
    }
    public  function satislar()
    {
        $satis=DB::select('SELECT s.*,u.urun_adi FROM siparis s,urunlers u WHERE s.urun_id=u.id and s.cevaplanma_durumu=0 and s.satici_id=?',[Auth::user()->id]);
        return view('satici.satislar',compact('satis'));
    }
    public  function onaylanmissatislar()
    {
        $satis=DB::select('SELECT s.*,u.urun_adi FROM siparis s,urunlers u WHERE s.urun_id=u.id and s.cevaplanma_durumu=1 and s.onaylanma_durumu=1 and s.satici_id=?',[Auth::user()->id]);
        return view('satici.onaylanmissatislar',compact('satis'));
    }
    public function silinmis()
    {
        $istekler=DB::select('SELECT u.*,t.adi as turu FROM urunlers u,turler t WHERE silinme_durumu=1 and u.tur_id=t.Id');
        return view('satici.silinmis',['istekler'=>$istekler]);
    }
    public  function yorumlar()
    {
        $yorumlar=DB::select('SELECT * FROM yorumlar y,urunlers u WHERE u.Id=y.urun_id and u.satici_id=?',[Auth::user()->id]);
        return view('satici.yorumlar',['yorumlar'=>$yorumlar]);
    }
    public function istekolustur()
    {
        $turler=DB::select('SELECT * FROM turler ORDER BY adi');
        $saticilar=DB::select('SELECT * FROM users');
        return view('satici.istekolustur',['turler'=>$turler],['saticilar'=>$saticilar]);
    }

    public function istekyolla(Request $request)
    {
        if($request->fiyat <= 0 ||$request->stok < 1)
            return redirect('satici/istekolustur')->with('message','Geçerli bilgiler giriniz.');
        if($request->hasfile('resim'))
        {
            $file=$request->file('resim');
            $name=time().$file->getClientOriginalName();
            $file->move(public_path().'/userfiles/',$name);
        }
        DB::table('urunlers')->insert([
            ['urun_adi'=>$request->get('adi'),
                'satici_id'=>$request->get('satici_id'),
                'keywords'=>$request->get('keywords'),
                'description'=>$request->get('description'),
                'tur_id'=>$request->get('tur_id'),
                'fiyat'=>$request->get('fiyat'),
                'stok'=>$request->get('stok'),
                'cevaplanma_durumu'=>0,
                'onaylanma_durumu'=>0,
                'silinme_durumu'=>0,
                'ortalama_puan'=>0,
                'satilan_adet'=>0,
                'resim'=>$name]
        ]);
        return redirect('satici/istekler')->with('success','Ürün isteği gönderildi.');
    }

    public function isteksil($id)
    {
        DB::table('urunlers')->where('Id','=',$id)->delete();
        return redirect('satici/istekler')->with('success','Ürün isteği silindi.');
    }
    public function urunkaldir($id)
    {
        $kontrol=DB::select('SELECT satici_id FROM urunlers WHERE Id=?',[$id]);
        if(Auth::user()->id ==$kontrol[0]->satici_id)
        {
            DB::table('urunlers')->where('Id','=',$id)->delete();
            return redirect('satici/satistakiurunler')->with('success','Ürün satıştan kaldırıldı.');
        }
        else
            return redirect('satici/satistakiurunler')->with('message','Sadece sizin sattığınız ürünleri satıştan kaldırabilirsiniz.');
    }

    public function urunguncelle($id)
    {
        $kontrol=DB::select('SELECT satici_id FROM urunlers WHERE Id=?',[$id]);
        if(Auth::user()->id ==$kontrol[0]->satici_id)
        {
            $turler=DB::select('SELECT * FROM turler ORDER BY adi');
            $urun=DB::select('select u.*,t.adi as turu from urunlers u,turler t where u.tur_id=t.Id and u.Id=?',[$id]);
            return view('satici.urun_guncelle',compact('urun','turler'));
        }
        return redirect('satici/satistakiurunler')->with('message','Sadece sizin sattığınız ürünleri güncelleyebilirsiniz.');
    }


    public function istekguncelle($id)
    {
        $kontrol=DB::select('SELECT satici_id FROM urunlers WHERE Id=?',[$id]);
        if(Auth::user()->id ==$kontrol[0]->satici_id)
        {
            $turler=DB::select('SELECT * FROM turler ORDER BY adi');
            $urun=DB::select('select u.*,t.adi as turu from urunlers u,turler t where u.tur_id=t.Id and u.Id=?',[$id]);
            return view('satici.istek_guncelle',compact('urun','turler'));
        }
        return redirect('satici/istekler')->with('message','Sadece kendi isteklerinizi güncelleyebilirsiniz.');
    }

    public function urunbilgisiguncelle(Request $request,$id)
    {
        if($request->get('fiyat') < 0 || $request->get('stok') < 1)
            return redirect('satici/satistakiurunler')->with('message','Geçerli bilgiler giriniz.');
        $kontrol=DB::select('SELECT * FROM urunlers WHERE Id=?',[$id]);
        if($kontrol[0]->satici_id == Auth::user()->id)
        {
            DB::table('urunlers')->where('Id','=',$id)->update([
                'fiyat'=>$request->get('fiyat'),
                'stok'=>$request->get('stok')
            ]);
            return redirect('satici/satistakiurunler')->with('success', 'Ürün bilgileri güncellendi.');
        }
        else
            return redirect('satici/satistakiurunler')->with('message', 'Sadece kendi ürünlerinizin bilgilerini güncelleyebilirsiniz.');
    }

    public function istekbilgisiguncelle(Request $request,$id)
    {
        if($request->hasfile('resim'))
        {
            $file=$request->file('resim');
            $name=time().$file->getClientOriginalName();
            $file->move(public_path().'/userfiles/',$name);
            DB::table('urunlers')->where('Id',$id)->update(['resim'=>$name]);
        }
        DB::table('urunlers')->where('Id',$id)->update([
                'urun_adi'=>$request->get('adi'),
                'keywords'=>$request->get('keywords'),
                'description'=>$request->get('description'),
                'tur_id'=>$request->get('tur_id'),
                'fiyat'=>$request->get('fiyat'),
                'stok'=>$request->get('stok')
        ]);
        return redirect('satici/istekler')->with('success',$request->adi.' adli ürün isteğiniz güncellendi.');
    }

    public function galeri($id)
    {
        $urun=DB::select('SELECT * FROM urunlers WHERE Id=?',[$id]);
        $resimler=DB::select('SELECT * FROM images WHERE urun_id=?',[$id]);
        $kontrol=DB::select('SELECT u.satici_id FROM urunlers u WHERE Id=?',[$id]);
        if($kontrol[0]->satici_id === Auth::user()->id)
        {
            return view('satici.galeri_ekleme',compact('urun','resimler'));
        }
        return redirect('satici/satistakiurunler');
    }

    public function galerigoruntule($id)
    {
        $urun=DB::select('SELECT * FROM urunlers WHERE Id=?',[$id]);
        $resimler=DB::select('SELECT * FROM images WHERE urun_id=?',[$id]);
        $kontrol=DB::select('SELECT u.satici_id FROM urunlers u WHERE Id=?',[$id]);
        if($kontrol[0]->satici_id === Auth::user()->id)
        {
            return view('satici.galerigoruntule',compact('resimler','urun'));
        }
        return redirect('satici/satistakiurunler');
    }

    public function galeriekle(Request $request)
    {
        if($request->hasfile('resim'))
        {
            $file=$request->file('resim');
            $name=time().$file->getClientOriginalName();
            $file->move(public_path().'/userfiles/',$name);
            DB::table('images')->insert(['urun_id'=>$request->id,'resim'=>$name]);
            return redirect('satici/galeri/'.$request->id)->with('success','Resim eklendi.');
        }
        else
        {
            return redirect('satici/galeri/'.$request->id)->with('message','Eklenecek resim seçilmedi.');
        }
    }

    public function galerisil($id)
    {
        $kontrol=DB::select('SELECT u.satici_id as satici_id,u.Id as urun_id FROM urunlers u,images i WHERE i.urun_id=u.Id and i.Id=?',[$id]);
        $kontrol2=DB::select('SELECT count(*) as c FROM images WHERE Id=?',[$id]);
        if($kontrol2[0]->c===0)
            return redirect('satici/satistakiurunler')->with('message','Resim zaten silinmiş.');
        if($kontrol[0]->satici_id === Auth::user()->id)
        {
            DB::select("DELETE FROM images WHERE Id=?",[$id]);
            return redirect('satici/galeri/'.$kontrol[0]->urun_id)->with('success','Resim silindi.');
        }
        return redirect('satici/satistakiurunler');
    }

    public function bizeyazinform()
    {
        if(!Auth::check() || !Auth::user()->role=='satici')
            return redirect('satici/login')->with('message','Bize yazmak için giriş yapmalısınız.');
        $turler=DB::select('SELECT * FROM turler ORDER BY adi');
        return view("satici.bizeyazin",compact('turler'));
    }

    public function bizeyazinyolla(Request $request,$id)
    {
        DB::table('admin_messages')->insert([
            ['sender_id'=>$id,
                'subject'=>$request->get('konu'),
                'message'=>$request->get('mesaj')
            ]
        ]);
        return redirect('satici/bizeyazin')->with('success','Mesajınız iletildi.');
    }

    public function alinanmesajlar()
    {
        $mesajlar=DB::select('SELECT * FROM messages m,users u WHERE m.sender_id=u.id and receiver_id=? ORDER BY tarih desc',[Auth::user()->id]);
        return view('satici.alinanmesajlar',compact('mesajlar'));

    }

    public function gonderilenmesajlar()
    {
        $admin_mesajlar=DB::select('SELECT * FROM admin_messages WHERE sender_id=? ORDER BY tarih desc',[Auth::user()->id]);
        $mesajlar=DB::select('SELECT * FROM messages m,users u WHERE m.receiver_id=u.id and sender_id=? ORDER BY m.tarih desc',[Auth::user()->id]);
        return view('satici.gonderilenmesajlar',compact('mesajlar','admin_mesajlar'));
    }

    public function mesajcevaplamaform($id)
    {
        $data=DB::select('SELECT * FROM settings');
        $receiver=DB::select('SELECT * FROM users WHERE id=?',[$id]);
        return view("satici.mesajcevaplama",compact('data','receiver'));
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
        return redirect('satici/gonderilenmesajlar')->with('success','Mesajınız iletildi.');
    }

    public function satisonay($id)
    {
        DB::table('siparis')->where('Id','=',$id)->update([
            'cevaplanma_durumu'=>1,
            'onaylanma_durumu'=>1,
            'degerlendirme_durumu'=>0
        ]);
        $satis=DB::select('SELECT s.*,u.urun_adi FROM siparis s,urunlers u WHERE s.urun_id=u.id and s.satici_id=?',[Auth::user()->id]);
        return redirect('satici/onaylanmissatislar')->with('success','Ürün satışı onaylandı.');
    }

    public function satisiptal($id)
    {
        DB::table('siparis')->where('Id','=',$id)->update([
            'cevaplanma_durumu'=>1,
            'onaylanma_durumu'=>0,
            'degerlendirme_durumu'=>1
        ]);
        $urun=DB::select('SELECT u.stok,s.miktar,u.id,u.satilan_adet FROM urunlers u,siparis s WHERE u.id=s.urun_id and s.Id=?',[$id]);
        $yenistok=$urun[0]->stok + $urun[0]->miktar;
        $yenisatilan=$urun[0]->satilan_adet - $urun[0]->miktar;
        DB::table('urunlers')->where('id','=',$urun[0]->id)->update([
            'stok'=>$yenistok,
            'satilan_adet'=>$yenisatilan
        ]);
        $satis=DB::select('SELECT s.*,u.urun_adi FROM siparis s,urunlers u WHERE s.urun_id=u.id and s.satici_id=?',[Auth::user()->id]);
        return redirect('satici/onaylanacaksatislar')->with('success','Ürün satışı iptal edildi.');
    }

}
