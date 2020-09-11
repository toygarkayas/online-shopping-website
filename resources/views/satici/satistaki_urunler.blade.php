@extends('layouts.satici.smaster')

@section('title','Satıştaki Ürünlerim')

@section('keywords','Deneme Satıcı Anahtar Kelimeler')

@section('content')
    @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div><br/>
    @endif
    @if(\Session::has('message'))
        <div class="alert alert-error">
            <p>{{\Session::get('message')}}</p>
        </div><br/>
    @endif
    <section class="content-header">
        <h1>
            Satıştaki Ürünlerim
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}/satici"><i class="fa fa-dashboard"></i>Anasayfa</a></li>
            <li><a href="#">Satıştaki Ürünlerim</a></li>
        </ol>
    </section>
    <div class="box">
        <div class="box-header with-border">
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tbody><tr>
                    <th>Ürün Numarası</th>
                    <th>Ürün Adı</th>
                    <th>Türü</th>
                    <th>Fiyatı</th>
                    <th>Stok Sayısı</th>
                    <th>Resim</th>
                    <th>Açıklama</th>
                    <th>Keywords</th>
                    <th>Galeri</th>
                    <th>Ürün Bilgisi Güncelle</th>
                    <th>Satıştan Kaldır</th>
                </tr>
                <?php $user_mail=\Illuminate\Support\Facades\Auth::user()->email; ?>
                @foreach($istekler as $istek)
                    @if($istek->cevaplanma_durumu === 1 && $istek->onaylanma_durumu === 1 && $user_mail === $istek->email)
                    <tr>
                        <td name="Id">{{$istek->Id}}</td>
                        <td>{{$istek->urun_adi}}</td>
                        <td>{{$istek->tur}}</td>
                        <td>{{$istek->fiyat}}</td>
                        <td>{{$istek->stok}}</td>
                        <td><img src="{{url('/')}}/userfiles/{{$istek->resim}}" height ="100"></td>
                            <td>{{$istek->description}}</td>
                            <td>{{$istek->keywords}}</td>
                        <td><a href="{{url('/')}}/satici/galerigoruntule/{{$istek->Id}}" onclick="return !window.open(this.href,'','top=100 left=200 width=800,height=600')" class="btn btn-info pull-right">Galeri Görüntüle</a></td>
                        <td><a href="{{url('/')}}/satici/urunguncelle/{{$istek->Id}}" class="btn btn-block btn-primary btn-xs">Ürün Bilgisi Güncelle</a></td>
                        <td><a href="{{url('/')}}/satici/urunkaldir/{{$istek->Id}}" class="btn btn-block btn-danger btn-xs" onclick="return confirm('Ürününüzü satıştan kaldırmak istediğinize emin misiniz ?') && confirm('Satıştan kaldırma işlemi gerçekleştirilecek son kararınız mı ?')">Satıştan Kaldır</a></td>
                    </tr>
                    @endif
                @endforeach
                </tbody></table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
            </ul>
        </div>
    </div>
@endsection
