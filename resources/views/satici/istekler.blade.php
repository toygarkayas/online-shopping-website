@extends('layouts.satici.smaster')

@section('title','İsteklerim')

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
            İstek Listem
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}/satici"><i class="fa fa-dashboard"></i>Anasayfa</a></li>
            <li><a href="#">İsteklerim</a></li>
        </ol>
    </section>
    <div class="box">
        <div class="box-header with-border">
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tbody><tr>
                    <th>İstek Numarası</th>
                    <th>Ürün Adı</th>
                    <th>Türü</th>
                    <th>Fiyatı</th>
                    <th>Stok Sayısı</th>
                    <th>Resim</th>
                    <th>Cevaplanma Durumu</th>
                    <th>Onaylanma Durumu</th>
                    <th>Güncelle</th>
                    <th>Sil</th>
                </tr>
                <?php $user_mail=\Illuminate\Support\Facades\Auth::user()->email; ?>
                @foreach($istekler as $istek)
                    @if($user_mail === $istek->email)
                    <tr>
                        <td name="Id">{{$istek->Id}}</td>
                        <td>{{$istek->urun_adi}}</td>
                        <td>{{$istek->tur}}</td>
                        <td>{{$istek->fiyat}}</td>
                        <td>{{$istek->stok}}</td>
                        <td><img src="{{url('/')}}/userfiles/{{$istek->resim}}" height ="100"></td>
                        @if($istek->cevaplanma_durumu === 0)
                            <td>Admin Cevabı Bekleniyor.</td>
                            <td></td>
                            <td><a href="{{url('/')}}/satici/istekguncelle/{{$istek->Id}}" class="btn btn-block btn-primary btn-xs">İsteği Güncelle</a></td>
                            <td><a href="{{url('/')}}/satici/isteksil/{{$istek->Id}}" class="btn btn-block btn-danger btn-xs" onclick="return confirm('İsteğinizi silmek istediğinize emin misiniz ?') && confirm('Gönderilmiş isteğiniz silinecek son kararınız mı ?')">İsteği Sil</a></td>
                        @elseif($istek->onaylanma_durumu === 0)
                            <td>Cevaplandı</td>
                            <td>Onaylanmadı</td>
                        @elseif($istek->onaylanma_durumu === 1)
                            <td>Cevaplandı</td>
                            <td>Onaylandı</td>
                        @endif
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
