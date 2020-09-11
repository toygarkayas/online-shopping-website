@extends('layouts.front.fmaster')

@section('title',$data[0]->adi)
@section('keywords',$data[0]->keywords)
@section('description',$data[0]->description)

@section('sidebar')
    @include('front.fsidebar')
@endsection

@section('content')
    <hr class="soften">
    <div>
        <h1>İletişim Bilgileri</h1>
    </div>
    <hr class="soften">
    <div class="row">
        <div class="span8">
            Email:{{$data[0]->email}}<br><br>
            Telefon:{{$data[0]->tel}}<br><br>
            Facebook:{{$data[0]->facebook}}<br><br>
            Youtube:{{$data[0]->youtube}}<br><br>
            Instagram:{{$data[0]->instagram}}<br><br>
            Twitter:{{$data[0]->twitter}}<br><br>
        </div>
    </div>


@endsection
