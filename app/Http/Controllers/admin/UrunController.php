<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UrunController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sql='select u.Id,t.adi as turu,s.email as satici,u.urun_adi,u.resim,u.fiyat,u.stok,u.onaylanma_durumu,u.cevaplanma_durumu
        from urunlers u,turler t,users s
        where u.tur_id=t.Id and u.satici_id=s.Id and silinme_durumu=0
        ORDER by id';

        $urunler = DB::select($sql);
        return view('admin.urun_listesi',['urunler'=>$urunler]);
    }
    public function destroy($id)
    {
        DB::table('urunlers')->where('Id','=',$id)->update(['silinme_durumu'=>1]);
        return redirect('admin/istekler')->with('success','Ürün isteği silindi.');
    }

    public function onay($id)
    {
        $urun=DB::select('SELECT * FROM urunlers WHERE Id=?',[$id]);
        if($urun[0]->onaylanma_durumu==1 && $urun[0]->silinme_durumu===0 && $urun[0]->cevaplanma_durumu==1)
            return redirect('admin/istekler')->with('success','Ürün zaten onaylanmış.');
        elseif($urun[0]->silinme_durumu===1)
            return redirect('admin/istekler')->with('success','Ürün silinmiş.');
        else
        {
            $istek = DB::table('urunlers')
                ->where('Id', $id)
                ->update(['cevaplanma_durumu' => 1,'onaylanma_durumu' => 1,'silinme_durumu'=>0]);
            return redirect('admin/onayistekler')->with('success','Ürün onaylandı.');
        }
    }

    public  function red($id)
    {
        $urun=DB::select('SELECT * FROM urunlers WHERE Id=?',[$id]);
        if($urun[0]->onaylanma_durumu==0 && $urun[0]->silinme_durumu===0 && $urun[0]->cevaplanma_durumu==1)
            return redirect('admin/istekler')->with('success','Ürün zaten onaylanmamış.');
        elseif($urun[0]->silinme_durumu===1)
            return redirect('admin/istekler')->with('success','Ürün silinmiş.');
        else
        {
            $istek = DB::table('urunlers')
                ->where('Id', $id)
                ->update(['cevaplanma_durumu' => 1,'onaylanma_durumu' => 0]);
            return redirect('admin/redistekler')->with('success','Ürün onaylanmadı.');
        }
    }

    public function istekler()
    {
        $sql='select i.Id,t.adi as turu,s.email as satici,i.urun_adi,i.fiyat,i.stok,i.resim,i.keywords,i.description,i.cevaplanma_durumu,i.onaylanma_durumu
        from urunlers i,turler t,users s
        where i.tur_id=t.Id and i.satici_id=s.Id and i.cevaplanma_durumu=0 and i.silinme_durumu=0
        ORDER by id';
        $istekler = DB::select($sql);
        return view('admin.istek_listesi',['istekler'=>$istekler]);
    }

    public function onayistekler()
    {
        $sql='select i.Id,t.adi as turu,s.email as satici,i.urun_adi,i.fiyat,i.stok,i.resim,i.keywords,i.description,i.cevaplanma_durumu,i.onaylanma_durumu
        from urunlers i,turler t,users s
        where i.tur_id=t.Id and i.satici_id=s.Id and i.cevaplanma_durumu=1 and i.onaylanma_durumu=1 and i.silinme_durumu=0
        ORDER by id';
        $istekler = DB::select($sql);
        return view('admin.onay_istekler',['istekler'=>$istekler]);
    }

    public function redistekler()
    {
        $sql='select i.Id,t.adi as turu,s.email as satici,i.urun_adi,i.fiyat,i.stok,i.resim,i.keywords,i.description,i.cevaplanma_durumu,i.onaylanma_durumu
        from urunlers i,turler t,users s
        where i.tur_id=t.Id and i.satici_id=s.Id and i.cevaplanma_durumu=1 and i.onaylanma_durumu=0 and i.silinme_durumu=0
        ORDER by id';
        $istekler = DB::select($sql);
        return view('admin.red_istekler',['istekler'=>$istekler]);
    }

    public function istatistikler()
    {
        $urunler=DB::select('SELECT * FROM urunlers WHERE cevaplanma_durumu=1 and onaylanma_durumu=1 and silinme_durumu=0');
        return view('admin.istatistikler',['urunler'=>$urunler]);
    }

    public function istatistikgoruntule($id)
    {
        $urunler=DB::select('SELECT sum(yildiz) as s FROM yorumlar WHERE urun_id=?',[$id]);
        $urun=DB::select('SELECT count(*) as s FROM yorumlar WHERE urun_id=?',[$id]);
        if($urunler[0]->s==0)
            echo 'Ürün henüz değerlendirilmemiş.';
        else
        {
            echo 'Ürünün Ortalama Puanı:';
            echo $urunler[0]->s / $urun[0]->s;
        }
    }

}
