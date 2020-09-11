@extends('layouts.front.fmaster')

@section('title','Siparişlerim')
@section('keywords','')
@section('description','')

@section('content')
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
    <h1>
        Siparişlerim
    </h1>
    <div class="box">
        <div class="box-body">
            <table class="table table-bordered">
                <tbody><tr>
                    <th>Sipariş ID</th>
                    <th>Satıcı ID</th>
                    <th>Ürün Adı</th>
                    <th>Ürün ID</th>
                    <th>Adres</th>
                    <th>Miktar</th>
                    <th>Tutar</th>
                    <th>Tarih</th>
                    <th>Satıcıya Mesaj Yolla</th>
                    <th>Durum</th>
                    <th>Ürünü Değerlendir</th>
                </tr>

                @foreach($siparis as $mesaj)
                    <tr>
                        <td>{{$mesaj->Id}}</td>
                        <td>{{$mesaj->satici_id}}</td>
                        <td>{{$mesaj->urun_adi}}</td>
                        <td>{{$mesaj->urun_id}}</td>
                        <td>{{$mesaj->adres}}</td>
                        <td>{{$mesaj->miktar}}</td>
                        <td>{{$mesaj->tutar}}</td>
                        <td>{{$mesaj->tarih}}</td>
                        <td><a class="btn btn-default" href="{{url('/')}}/smesajcevaplama/{{$mesaj->satici_id}}">Satıcıya Mesaj Yolla</a></td>
                        @if($mesaj->onaylanma_durumu === 1 && $mesaj->cevaplanma_durumu === 1)
                            <td>Onaylandı.</td>
                            @if($mesaj->degerlendirme_durumu === 0)
                                <td><a class="btn btn-default" href="{{url('/')}}/degerlendirmeformu/{{$mesaj->Id}}">Ürünü Değerlendir</a></td>
                            @else
                                <td></td>
                            @endif
                       @elseif($mesaj->onaylanma_durumu === 0 && $mesaj->cevaplanma_durumu === 1)
                            <td>Satış iptal edildi.</td>
                            <td></td>
                        @elseif($mesaj->cevaplanma_durumu === 0)
                            <td>Satıcı onayı bekleniyor.</td>
                            <td></td>
                        @endif
                    </tr>
                @endforeach
                </tbody></table>
        </div>
    </div>
@endsection
