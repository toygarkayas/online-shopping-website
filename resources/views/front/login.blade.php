@extends('layouts.front.fmaster')

@section('title','Giriş Yap')
@section('keywords','')
@section('description','giriş yap veya kaydol')

@section('content')
    <ul class="breadcrumb">
        <li><a href="{{url('/')}}">Anasayfa</a> <span class="divider">/</span></li>
        <li><a href="{{url('/')}}/login">Giriş Yap</a> <span class="divider">/</span></li>
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
            <h5>Giriş Yap</h5>
            <form class="form-horizontal loginFrm" method="post" action="{{url('/')}}/login">
                @csrf
                <div class="control-group">
                    <input type="text" class="span2" name="email" placeholder="Email" required>
                </div>
                <div class="control-group">
                    <input type="password" class="span2" name="password" placeholder="Password" required>
                </div>
                <div class="control-group">
                    <button type="submit" class="shopBtn btn-block">Giriş Yap</button>
                    <a href="{{url('/')}}/register">Kayıt Ol</a>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
