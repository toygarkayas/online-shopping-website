@extends('layouts.satici.smaster')

@section('title','Ürün Bilgileri Güncelle')

@section('keywords','Deneme Satıcı Anahtar Kelimeler')

@section('content')
<section class="content-header">
    <h1>
        Ürün Bilgisi Güncelle
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}/satici"><i class="fa fa-dashboard"></i>Anasayfa</a></li>
        <li><a href="{{url('/')}}/satici/satistakiurunler"><i class="fa fa-dashboard"></i>Satıştaki Ürünler</a></li>
        <li><a href="#">Ürün Düzenleme</a></li>
    </ol>
</section>
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Ürün Güncelleme Formu</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
            <table class="table table-bordered">
                <tbody><tr>
                    <th>Ürün Numarası</th>
                    <th>Ürün Adı</th>
                    <th>Türü</th>
                    <th>Fiyatı</th>
                    <th>Stok Sayısı</th>
                    <th>Resim</th>
                    <th>Galeri</th>
                    <th>Açıklama</th>
                    <th>Keywords</th>
                </tr>
                <tr>
                    <td>{{$urun[0]->Id}}</td>
                    <td>{{$urun[0]->urun_adi}}</td>
                    <td>{{$urun[0]->turu}}</td>
                    <td>{{$urun[0]->fiyat}}</td>
                    <td>{{$urun[0]->stok}}</td>
                    <td><img src="{{url('/')}}/userfiles/{{$urun[0]->resim}}" height ="100"></td>
                    <td><a href="{{url('/')}}/satici/galeri/{{$urun[0]->Id}}" onclick="return !window.open(this.href,'','top=100 left=200 width=800,height=600')" class="btn btn-info pull-right">Ürüne Resim Ekle</a></td>
                    <td>{{$urun[0]->description}}</td>
                    <td>{{$urun[0]->keywords}}</td>
                </tr></tbody>
            </table>
        </div>
        <form class="form-horizontal" action="{{url('/')}}/satici/urunbilgisiguncelle/{{$urun[0]->Id}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Fiyat</label>
                    <div class="col-sm-10">
                        <input type="text" name="fiyat" value="{{$urun[0]->fiyat}}" class="form-control" placeholder="Fiyat" min="0" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Stok Sayısı</label>
                    <div class="col-sm-10">
                        <input type="text" name="stok" value="{{$urun[0]->stok}}" class="form-control" placeholder="Stok" min="0" required>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{url('/')}}/satici/satistakiurunler" class="btn btn-info pull-right" onclick="return confirm('İptal etmek istediğinize emin misiniz ?')">İptal</a>
                    <button type="submit" class="btn btn-info pull-right" onclick="return confirm('Ürün bilgilerinizi girdiğiniz şekilde güncellemek istediğinize emin misiniz ?')">Ürün Bilgisi Güncelle</button>
                </div>
                <!-- /.box-footer -->
        </form>
    </div>
</div>
@endsection
