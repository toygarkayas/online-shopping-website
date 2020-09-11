@extends('layouts.satici.smaster')

@section('title','Deneme Satıcı')

@section('keywords','Deneme Satıcı Anahtar Kelimeler')

@section('content')
    @if(\Session::has('message'))
        <div class="alert alert-error">
            <p>{{\Session::get('message')}}</p>
        </div><br/>
    @endif
    <section class="content-header">
        <h1>
            İstek Oluştur
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}/satici"><i class="fa fa-dashboard"></i>Anasayfa</a></li>
            <li><a href="#">İstek Oluştur</a></li>
        </ol>
    </section>
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Ürün Ekleme Formu</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{url('/')}}/satici/istekyolla" method="post" enctype="multipart/form-data">
            @csrf
            <?php $user_mail=\Illuminate\Support\Facades\Auth::user()->email; ?>
            @foreach($saticilar as $satici)
                @if($satici->email === $user_mail)
                    <input class="hidden" name="satici_id" value="{{$satici->id}}">
                @endif
            @endforeach
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Ürün Adı</label>

                    <div class="col-sm-10">
                        <input type="text" name="adi" class="form-control" placeholder="Ürün adı" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Anahtar Kelimeler</label>

                    <div class="col-sm-10">
                        <input type="text" name="keywords" class="form-control" placeholder="Keywords" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Ürün Türü</label>
                    <div class="col-sm-10">
                    <select class="form-control" name="tur_id">
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
                    <input type="text" name="fiyat" value="0" class="form-control" placeholder="Fiyat" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Stok Sayısı</label>

                <div class="col-sm-10">
                    <input type="text" name="stok" value="0" class="form-control" placeholder="Stok Sayısı" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Ürün Açıklaması</label>

                <div class="col-sm-10">
                    <input type="text" name="description" class="form-control" placeholder="Ürün Açıklaması" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Ürün Resmi</label>
                <div class="col-sm-10">
                    <input type="file" name="resim" required>
                </div>
                <p class="help-block">Resim dosyası seçiniz.</p>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{url('/')}}/satici/istekler" class="btn btn-info pull-right" onclick="return confirm('İptal etmek istediğinize emin misiniz ?')">İptal</a>
                <button type="submit" class="btn btn-info pull-right" onclick="return confirm('İsteğinizi göndermek istediğinize emin misiniz ?')">İstek Oluştur</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
@endsection
