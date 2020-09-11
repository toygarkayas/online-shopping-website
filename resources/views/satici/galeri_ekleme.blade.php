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
            <li><a href="{{url('/')}}/satici/urunguncelle"><i class="fa fa-dashboard"></i>Ürün Bilgisi Güncelle</a></li>
            <li><a href="#">Ürün Galeri</a></li>
        </ol>
    </section>
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Ürün Galeri Formu</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{url('/')}}/satici/galeri/{{$urun[0]->Id}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
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
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{$urun[0]->urun_adi}}</label>
                </div>
                <img src="{{url('/')}}/userfiles/{{$urun[0]->resim}}" height="50">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Ürün Galeri Resim</label>
                    <div class="col-sm-10">
                        <input type="file" name="resim">
                    </div>
                    <p class="help-block"> Resim dosyası seçiniz.</p>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right" onclick="return confirm('Resimleri eklemek istediğinize emin misiniz ?')">Ekle</button>
                </div>
                <!-- /.box-footer -->
                <input type="hidden" name="id" value="{{$urun[0]->Id}}">
                @foreach($resimler as $rs)
                    <img src="{{url('/')}}/userfiles/{{$rs->resim}}" height="50">
                    <a href="{{url('/')}}/satici/galerisil/{{$rs->Id}}" class="btn btn-block btn-danger btn-xs" onclick="return confirm('Resmi silmek istediğinize emin misiniz ?') && confirm('Resim silinecek son kararınız mı ?')">Resmi Sil</a>
            @endforeach
        </form>
    </div>
    </div>
@endsection
