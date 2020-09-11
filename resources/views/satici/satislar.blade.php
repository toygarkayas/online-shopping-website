@extends('layouts.satici.smaster')

@section('title','Satışlar')

@section('keywords','Deneme Satıcı Anahtar Kelimeler')

@section('content')
    @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div><br/>
    @endif
    <section class="content-header">
        <h1>
            Satışlar
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}/satici"><i class="fa fa-dashboard"></i>Anasayfa</a></li>
            <li><a href="#">Satışlar</a></li>
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
                    <th>Onayla</th>
                    <th>Reddet</th>
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
                        <td>{{$istek->adres}}</td>
                        <td>{{$istek->adres}}</td>
                        <td><a href="{{url('/')}}/satici/satisonay/{{$istek->Id}}" class="btn btn-block btn-primary btn-xs" onclick="return confirm('Satışı onaylamak istediğinize emin misiniz ?')" >Satışı Onayla</a></td>
                        <td><a href="{{url('/')}}/satici/satisiptal/{{$istek->Id}}" class="btn btn-block btn-danger btn-xs" onclick="return confirm('Satışı iptal etmek istediğinize emin misiniz ?')">Reddet</a></td>
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
