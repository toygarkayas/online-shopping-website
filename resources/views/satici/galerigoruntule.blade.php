@extends('layouts.satici.galeri')

@section('title','Ürün Bilgileri Güncelle')

@section('keywords','Deneme Satıcı Anahtar Kelimeler')

@section('content')
    <section class="content-header">
        <h1>
            Ürün Galeri
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}/satici"><i class="fa fa-dashboard"></i>Anasayfa</a></li>
            <li><a href="{{url('/')}}/satici/satistakiurunler"><i class="fa fa-dashboard"></i>Satıştaki Ürünler</a></li>
            <li><a href="#">Ürün Galeri</a></li>
        </ol>
    </section>
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Ürün Galerisi</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal">
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{$urun[0]->urun_adi}}</label>
                </div>
                <img src="{{url('/')}}/userfiles/{{$urun[0]->resim}}" height="100">
                @foreach($resimler as $rs)
                    <img src="{{url('/')}}/userfiles/{{$rs->resim}}" height="100">
                @endforeach
        </form>
    </div>
    </div>
@endsection
