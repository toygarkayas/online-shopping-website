@extends('layouts.satici.smaster')

@section('title','Bize Yaz')
@section('keywords','')
@section('description','')

@section('content')
    <hr class="soften">
    @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div><br/>
    @endif
    <div>
        <h1>Bize Yazın</h1>
    </div>
    <form class="form-horizontal loginFrm" method="post" action="{{url('/')}}/satici/bizeyazin/{{\Illuminate\Support\Facades\Auth::user()->id}}">
        @csrf
        <div class="control-group">
            Konu: <textarea maxlength="254" rows="1" name="konu" class="input-medium"></textarea><br>
            Mesaj:<textarea maxlength="254" rows="3" name="mesaj" class="input-xlarge"></textarea>
        </div><br>
        <button class="shopBtn" type="submit" onclick="confirm('Yukarıdaki mesajı yollamak istediğinize emin misiniz ?')">Admine Mesaj Yolla</button>
    </form>
    </div>
@endsection
