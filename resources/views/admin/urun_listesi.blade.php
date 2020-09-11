@extends('layouts.admin.amaster')

@section('title','Ürünler Listesi')

@section('keywords','')

@section('content')
    <section class="content-header">
        <h1>
            Ürün Listesi
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
                    <th>Sil</th>
                </tr>

                @foreach($urunler as $urun)
                    @if($urun->cevaplanma_durumu === 1 && $urun->onaylanma_durumu === 1)
                        <tr>
                            <td>{{$urun->Id}}</td>
                            <td>{{$urun->turu}}</td>
                            <td>{{$urun->satici}}</td>
                            <td>{{$urun->urun_adi}}</td>
                            <td><img src="{{url('/')}}/userfiles/{{$urun->resim}}" height ="50"></td>
                            <td>{{$urun->fiyat}}</td>
                            <td>{{$urun->stok}}</td>
                            <td>
                                <a href="{{url('/')}}/admin/urun/del/{{$urun->Id}}" class="btn btn-block btn-danger btn-xs" onclick="return confirm('Ürünü satıştan kaldırmak istediğinize emin misiniz ?') && confirm('Silme işlemi gerçekleştirilecek son kararınız mı ?')">Sil</a>
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
