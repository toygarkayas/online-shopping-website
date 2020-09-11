<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }

    public function index()
    {
        $data=DB::select('SELECT * FROM settings');
        $menu='uye';
        return view('front.user_panel',compact('data','menu'));
    }

    public function sepeteekle(Request $request)
    {
        if(Auth::check())
        {
            DB::table('sepet')->insert([
                ['urun_id'=>$request->get('urunid'),
                    'user_id'=>Auth::user()->id,
                    'miktar'=>$request->get('miktar')]
            ]);
            $id=$request->get('urunid');
            return redirect("/urun/$id")->with('success','Ürünler sepete eklendi.');
        }
        return redirect('/login')->with('message','Sepete ürün ekleyebilmek için giriş yapmalısınız.');
    }
    //$menu='sepetim';

    public function sepetim()
    {
        if(Auth::check())
        {
            $sepetler=DB::select('SELECT * FROM urunlers u,sepet s WHERE u.Id=s.urun_id and s.user_id=? ORDER BY s.urun_id',[Auth::user()->id]);
            $data=DB::select('SELECT * FROM settings');
            $menu='sepetim';
            return view('front.sepetim',compact('sepetler','data','menu'));
        }
        return redirect('/login')->with('message','Sepete ürün ekleyebilmek için giriş yapmalısınız.');
    }

    public function sepettencikar($id)
    {
        if(Auth::check())
        {
            DB::select('DELETE FROM sepet WHERE urun_id=?', [$id]);
            return redirect("/sepetim")->with('success', 'Ürünler sepete çıkartıldı.');
        }
        return redirect('/login')->with('message','Sepete ürün ekleyebilmek için giriş yapmalısınız.');
    }

    public function alisverisitamamla(Request $request)
    {
        if(Auth::check())
        {
            $data=DB::select('SELECT * FROM settings');
            $user=DB::select('SELECT * FROM users WHERE id=?',[Auth::user()->id]);
            $toplam=$request->toplam;
            $menu='';
            if($request->toplam==0)
                return redirect("/sepetim");
            return view('front.alisverisitamamla',compact('data','menu','user','toplam'));
        }
        return redirect('/login')->with('message','Alışverişi tamamlayabilmek için giriş yapmalısınız.');
    }

    public function satinal(Request $request)
    {
        $sepetler=DB::select('SELECT * FROM urunlers u,sepet s WHERE s.urun_id=u.Id and s.user_id=? ORDER BY s.urun_id',[Auth::user()->id]);
        $data=DB::select('SELECT * FROM settings');
        $menu='sepet';
        $previous=0;
        $flag=1;
        $tutar=0;
        foreach ($sepetler as $key=>$val)
        {
            if($previous==$sepetler[$key]->urun_id)
            {
                $flag=0;
            }
            else
            {
                $j=1;
                $adet=$sepetler[$key]->miktar;
                while($key+$j < count($sepetler) && $sepetler[$key]->urun_id==$sepetler[$key+$j]->urun_id)
                {
                    $adet=$adet+$sepetler[$key+$j]->miktar;
                    $j++;
                }
                $tutar=$adet * $sepetler[$key]->fiyat;
                $previous=$sepetler[$key]->urun_id;
                $flag=1;
            }
            if($flag)
            {
                DB::table('siparis')->insert([
                    ['user_id'=>Auth::user()->id,
                        'satici_id'=>$sepetler[$key]->satici_id,
                        'urun_id'=>$sepetler[$key]->urun_id,
                        'adsoy'=>$request->adsoy,
                        'adres'=>$request->adres,
                        'tel'=>$request->tel,
                        'miktar'=>$adet,
                        'tutar'=>$tutar
                    ]
                ]);
                DB::table('urunlers')->where('id','=',$sepetler[$key]->urun_id)->update([
                    'stok'=>$sepetler[$key]->stok-$adet,
                    'satilan_adet'=>$sepetler[$key]->satilan_adet+$adet
                ]);
            }
        }

        DB::table('sepet')->where('user_id','=',[Auth::user()->id])->delete();
        $siparis=DB::select('SELECT * FROM siparis s,urunlers u WHERE s.urun_id=u.id and user_id=?',[Auth::user()->id]);
        return redirect('siparislerim')->with('success','Alışveriş tamamlandı.');
    }

    public function siparislerim()
    {
        if(Auth::check())
        {
            $siparis = DB::select('SELECT s.*,u.id,u.urun_adi FROM siparis s,urunlers u WHERE s.urun_id=u.id and user_id=?', [Auth::user()->id]);
            $data = DB::select('SELECT * FROM settings');
            $menu = 'siparisler';
            return view('front.siparislerim', compact('data', 'menu', 'siparis'));
        }
        return redirect('/login')->with('message','Sepete ürün ekleyebilmek için giriş yapmalısınız.');
    }

    public function degerlendirmeformu($id)
    {
        if(Auth::check())
        {
            $receiver=DB::select('SELECT * FROM siparis s WHERE s.Id=?',[$id]);
            if($receiver[0]->user_id == Auth::user()->id && $receiver[0]->degerlendirme_durumu==0 && $receiver[0]->cevaplanma_durumu==1 && $receiver[0]->onaylanma_durumu==1)
            {
                $data=DB::select('SELECT * FROM settings');
                $menu='siparisler';
                return view('front.degerlendirmeformu',compact('data','menu','receiver'));
            }
            else
                return redirect('/siparislerim')->with('message','Ürünü daha önce değerlendirmişsiniz veya ürünün satışı tamamlanmamış.');
        }
        return redirect('/login')->with('message','Değerlendirme için giriş yapmalısınız.');
    }

    public function degerlendir(Request $request,$id)
    {
        if(Auth::check())
        {
            $data = DB::select('SELECT * FROM settings');
            $menu = 'siparisler';
            $urun = DB::select('SELECT u.Id FROM urunlers u,siparis s WHERE u.Id=s.urun_id and s.Id=?', [$id]);
            DB::table('yorumlar')->insert([
                ['user_id' => Auth::user()->id,
                    'urun_id' => $urun[0]->Id,
                    'yorum' => $request->yorum,
                    'yildiz' => $request->rate
                ]
            ]);
            DB::table('siparis')->where('Id', '=', $id)->update([
                'degerlendirme_durumu' => 1
            ]);
            return redirect('siparislerim')->with('success', 'Ürüne yaptığınız değerlendirme kaydedildi.');
        }
        return redirect('/login')->with('message','Değerlendirme için giriş yapmalısınız.');
    }

}
