@extends('layouts.satici.smaster')

@section('title','Yorumlar')

@section('keywords','')

@section('content')
    @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div><br/>
    @endif
    <section class="content-header">
        <h1>
            İstek Listem
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}/satici"><i class="fa fa-dashboard"></i>Anasayfa</a></li>
            <li><a href="#">İsteklerim</a></li>
        </ol>
    </section>
    <div class="box">
        <div class="box-header with-border">
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php $previous=0; ?>
                @foreach($yorumlar as $yorum)
                    @if(!($previous==$yorum->urun_id))
                    <th>{{$yorum->urun_id}} numaralı Ürün</th>
                    @endif
                    <table class="table table-bordered">
                        <tbody><tr>
                            <th>Puan</th>
                            <th>Yorum</th>
                            <th>Değerlendirme Yapan Kişi ID</th>
                        </tr>
                        <tr>
                            <td>{{$yorum->yildiz}}</td>
                            <td>{{$yorum->yorum}}</td>
                            <td>{{$yorum->user_id}}</td>
                        </tr>
                    </tbody></table>
                <?php $previous=$yorum->urun_id; ?>
                @endforeach
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
