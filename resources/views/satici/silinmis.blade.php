@extends('layouts.satici.smaster')

@section('title','İsteklerim')

@section('keywords','Deneme Satıcı Anahtar Kelimeler')

@section('content')
    @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div><br/>
    @endif
    <section class="content-header">
        <h1>
            Admin Tarafından Satıştan Kaldırılmış Ürünler
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}/satici"><i class="fa fa-dashboard"></i>Anasayfa</a></li>
            <li><a href="#">Kaldırılan Ürünlerim</a></li>
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
                </tr>

                @foreach($istekler as $istek)
                    <tr>
                        <td name="Id">{{$istek->Id}}</td>
                        <td>{{$istek->urun_adi}}</td>
                        <td>{{$istek->turu}}</td>
                        <td>{{$istek->fiyat}}</td>
                        <td>{{$istek->stok}}</td>
                        <td><img src="{{url('/')}}/userfiles/{{$istek->resim}}" height ="100"></td>
                    </tr>
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
