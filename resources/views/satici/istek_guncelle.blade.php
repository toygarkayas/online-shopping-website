@extends('layouts.satici.smaster')

@section('title','İstek Bilgileri Güncelle')

@section('keywords','Deneme Satıcı Anahtar Kelimeler')

@section('content')
    <section class="content-header">
        <h1>
            İstek Bilgisi Güncelle
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}/satici"><i class="fa fa-dashboard"></i>Anasayfa</a></li>
            <li><a href="{{url('/')}}/satici/istekler"><i class="fa fa-dashboard"></i>İsteklerim</a></li>
            <li><a href="#">İstek Düzenleme</a></li>
        </ol>
    </section>
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">İstek Güncelleme Formu</h3>
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
                    <th>Açıklama</th>
                    <th>Keywords</th>
                </tr>
                <tr>
                    <td name="Id">{{$urun[0]->Id}}</td>
                    <td>{{$urun[0]->urun_adi}}</td>
                    <td>{{$urun[0]->turu}}</td>
                    <td>{{$urun[0]->fiyat}}</td>
                    <td>{{$urun[0]->stok}}</td>
                    <td><img src="{{url('/')}}/userfiles/{{$urun[0]->resim}}" height ="100"></td>
                    <td>{{$urun[0]->description}}</td>
                    <td>{{$urun[0]->keywords}}</td>
                </tr></tbody>
            </table>
        </div>
        <form class="form-horizontal" action="{{url('/')}}/satici/istekbilgisiguncelle/{{$urun[0]->Id}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Ürün Adı</label>

                    <div class="col-sm-10">
                        <input type="text" name="adi" value="{{$urun[0]->urun_adi}}" class="form-control" placeholder="Ürün adı">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Anahtar Kelimeler</label>

                    <div class="col-sm-10">
                        <input type="text" name="keywords" value="{{$urun[0]->keywords}}" class="form-control" placeholder="Keywords">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Ürün Türü</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="tur_id">
                            <option selected value="{{$urun[0]->tur_id}}">{{$urun[0]->turu}}</option>
                            @foreach($turler as $tur)
                                <option value="{{$tur->Id}}">{{$tur->adi}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Fiyat</label>

                <div class="col-sm-10">
                    <input type="text" name="fiyat" value="{{$urun[0]->fiyat}}" class="form-control" placeholder="Fiyat">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Stok Sayısı</label>

                <div class="col-sm-10">
                    <input type="text" name="stok" value="{{$urun[0]->stok}}" class="form-control" placeholder="Stok Sayısı">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Ürün Açıklaması</label>

                <div class="col-sm-10">
                    <input type="text" name="description" value="{{$urun[0]->description}}" class="form-control" placeholder="Ürün Açıklaması">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Ürün Resmi</label>
                <div class="col-sm-10">
                    <input type="file" value="{{$urun[0]->resim}}" name="resim">
                </div>
                <img src="{{url('/')}}/userfiles/{{$urun[0]->resim}}" height="100">
                <p class="help-block">Resim dosyası seçiniz.</p>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{url('/')}}/satici/istekler" class="btn btn-info pull-right">İptal</a>
                <button type="submit" class="btn btn-info pull-right" onclick="return confirm('İsteğinizi güncellemek istediğinize emin misiniz ?')">İstek Güncelle</button>
            </div>
            <!-- /.box-footer -->
        </form>
        </div>
    </div>
@endsection
