@extends('layouts.satici.smaster')

@section('title','Onaylanmış Satışlar')

@section('keywords','Deneme Satıcı Anahtar Kelimeler')

@section('content')
    @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div><br/>
    @endif
    <section class="content-header">
        <h1>
            Onaylanmış Satışlar
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}/satici"><i class="fa fa-dashboard"></i>Anasayfa</a></li>
            <li><a href="#">Onaylanmış Satışlar</a></li>
        </ol>
    </section>
    <div class="box">
        <div class="box-header with-border">
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tbody><tr>
                    <th>Sipariş Numarası</th>
                    <th>Müşteri ID</th>
                    <th>Ürün Adı</th>
                    <th>Ürün ID</th>
                    <th>Miktar</th>
                    <th>Adres</th>
                    <th>Telefon</th>
                    <th>Tutar</th>
                </tr>
                @foreach($satis as $istek)
                    <tr>
                        <td name="Id">{{$istek->Id}}</td>
                        <td>{{$istek->user_id}}</td>
                        <td>{{$istek->urun_adi}}</td>
                        <td>{{$istek->urun_id}}</td>
                        <td>{{$istek->miktar}}</td>
                        <td>{{$istek->adres}}</td>
                        <td>{{$istek->tel}}</td>
                        <td>{{$istek->tutar}}</td>
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
