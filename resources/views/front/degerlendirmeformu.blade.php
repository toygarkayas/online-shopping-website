@extends('layouts.front.fmaster')

@section('title','Ürün Değerlendir')
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
        <h1>{{$receiver[0]->Id}} numaralı siparişinizi değerlendirin.</h1>
    </div>
    <form class="form-horizontal loginFrm" method="post" action="{{url('/')}}/degerlendir/{{$receiver[0]->Id}}">
        @csrf
        <div class="control-group">
            <div class="rate" required>
                5
                <input type="radio" id="star5" name="rate" value="5" required/>
                4
                <input type="radio" id="star4" name="rate" value="4" />
                3
                <input type="radio" id="star3" name="rate" value="3" />
                2
                <input type="radio" id="star2" name="rate" value="2" />
                1
                <input type="radio" id="star1" name="rate" value="1" />
            </div>
            Yorum:<textarea maxlength="254" rows="3" name="yorum" class="input-xlarge"></textarea>
        </div><br>
        <button class="shopBtn" type="submit" onclick="confirm('Yukarıdaki değerlendirme formunu yollamak istediğinize emin misiniz ?')">Değerlendir</button>
    </form>
    </div>

@endsection
