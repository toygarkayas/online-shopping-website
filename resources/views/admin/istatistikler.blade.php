@extends('layouts.admin.amaster')

@section('title','İstatistikler')

@section('keywords','')

@section('content')
    <section class="content-header">
        <h1>
            Ürünler
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}/admin"><i class="fa fa-dashboard"></i>Anasayfa</a></li>
            <li><a href="#">Istatistikler</a></li>
        </ol>
    </section>
    <div class="box">
        <div class="box-header with-border">
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tbody><tr>
                    <th>ID</th>
                    <th>Satıcı</th>
                    <th>Adı</th>
                    <th>Resim</th>
                    <th>Fiyat</th>
                    <th>Stok</th>
                    <th>Satılan Adet</th>
                    <th>Istatistikler</th>
                </tr>

                @foreach($urunler as $istek)
                    @if($istek->cevaplanma_durumu === 1 && $istek->onaylanma_durumu === 1 && $istek->silinme_durumu === 0)
                        <tr>
                            <td>{{$istek->Id}}</td>
                            <td>{{$istek->satici_id}}</td>
                            <td>{{$istek->urun_adi}}</td>
                            <td><img src="{{url('/')}}/userfiles/{{$istek->resim}}" height ="100"></td>
                            <td>{{$istek->fiyat}}</td>
                            <td>{{$istek->stok}}</td>
                            <td>{{$istek->satilan_adet}}</td>
                            <td>
                                <a href="{{url('/')}}/admin/istatistikgoruntule/{{$istek->Id}}" onclick="return !window.open(this.href,'','top=100 left=200 width=100,height=100')" class="btn btn-block btn-primary btn-xs">Ortalama Puan</a>
                            </td>
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
