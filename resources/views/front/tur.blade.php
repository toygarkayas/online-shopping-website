@extends('layouts.front.fmaster')

@section('title','Kategori')
@section('keywords','')
@section('description','')

@section('sidebar')
    @include('front.fsidebar')
@endsection
@section('content')
        @foreach($urunler as $uruns)
                <li class="span3">
                    <div class="thumbnail">
                        <a class="zoomTool" href="{{url('/')}}/urun/{{$uruns->Id}}" title="add to cart"><span class="icon-search"></span> QUICK VIEW</a>
                        <a href="#" class="tag"></a>
                        <a href="{{url('/')}}/urun/{{$uruns->Id}}"><img src="{{url('/')}}/userfiles/{{$uruns->resim}}" alt="bootstrap-ring"></a>
                    </div>
                </li>
        @endforeach
@endsection
