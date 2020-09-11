@extends('layouts.admin.amaster')

@section('title','İstek Listesi')

@section('keywords','')

@section('content')
    @if(\Session::has('success'))
        <div class="alert alert-error">
            <p>{{\Session::get('success')}}</p>
        </div><br/>
    @endif
    <section class="content-header">
        <h1>
            Bekleyen İstek Listesi
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}/admin"><i class="fa fa-dashboard"></i>Anasayfa</a></li>
            <li><a href="#">Ürünler</a></li>
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
                    <th>Türü</th>
                    <th>Satıcı</th>
                    <th>Adı</th>
                    <th>Resim</th>
                    <th>Fiyat</th>
                    <th>Stok</th>
                    <th>Açıklama</th>
                    <th>Anahtar Kelimeler</th>
                    <th>Onayla</th>
                    <th>Reddet</th>
                </tr>

                @foreach($istekler as $istek)
                    @if($istek->cevaplanma_durumu === 0)
                        <tr>
                            <td>{{$istek->Id}}</td>
                            <td>{{$istek->turu}}</td>
                            <td>{{$istek->satici}}</td>
                            <td>{{$istek->urun_adi}}</td>
                            <td><img src="{{url('/')}}/userfiles/{{$istek->resim}}" height ="100"></td>
                            <td>{{$istek->fiyat}}</td>
                            <td>{{$istek->stok}}</td>
                            <td>{{$istek->description}}</td>
                            <td>{{$istek->keywords}}</td>
                            <td>
                                <a href="{{url('/')}}/admin/istek/onay/{{$istek->Id}}" class="btn btn-block btn-primary btn-xs" onclick="return confirm('Gönderilmiş isteği onaylamak istediğinize emin misiniz ?')">Onayla</a>
                            </td>
                            <td>
                                <a href="{{url('/')}}/admin/istek/red/{{$istek->Id}}" class="btn btn-block btn-danger btn-xs" onclick="return confirm('Gönderilmiş isteği reddetmek istediğinize emin misiniz ?')">Reddet</a>
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
