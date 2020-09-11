@extends('layouts.front.fmaster')

@section('title','Kullanıcı Paneli')
@section('keywords','')
@section('description','panel')

@section('fsidebar')
    @include('front.usersidebar')
@endsection

@section('content')
    <ul class="breadcrumb">
        <li><a href="{{url('/')}}">Anasayfa</a> <span class="divider">/</span></li>
        <li><a href="{{url('/user')}}">Kullanıcı</a> <span class="divider">/</span></li>
    </ul>
    @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div><br/>
    @elseif(\Session::has('message'))
        <div class="alert-error">
            <p>{{\Session::get('message')}}</p>
        </div>
    @endif
    <div class="row">
        <div class="span4">
            <div class="well">
                <h5>Kullanıcı Paneli</h5>
                DASHBOARD
            </div>
        </div>
    </div>
@endsection
