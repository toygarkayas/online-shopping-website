@extends('layouts.front.fmaster')

@section('title','Alışverişi Tamamla')
@section('keywords','')
@section('description','')

@section('sidebar')
    @include('front.usersidebar')
@endsection

@section('content')
    <hr class="soften">
    <div>
        <h1>Alışverişi Tamamla</h1>
    </div>
    @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div><br/>
    @endif
                    <form method="post" action="{{url('/')}}/satinal">
                        @csrf
                        Sipariş Tutarı:<input type="text" readonly name="toplam" value="<?php echo $toplam; ?> TL"><br><hr>
                        <b>Kargo Bilgileri</b><br><hr>
                        Adı Soyadı:<input type="text" name="adsoy" maxlength="254" value="{{$user[0]->name}}" required><br>
                        Adresi____:<input type="text" name="adres" maxlength="254" value="" required><br>
                        Telefon Numarası:<input type="tel" name="tel" maxlength="254" value="" required><br><br><br>


                        <b>Kredi Kartı Bilgileri</b><br><hr>
                        Adı Soyadı:<input name="kart" maxlength="254" value="" ><br>
                        Kart No___:<input name="kartno" maxlength="20" value="" ><br>
                        Son Kullanım Tarihi Ay/Yıl:<input name="ay" maxlength="20" value=""> / <input name="yil" maxlength="20" value=""><br>
                        Güvenlik Numarası    (CVC):<input type="number" name="cvc" maxlength="3" value=""><br>
                        <td><input type="submit" class="btn btn-success" onclick="confirm('Satın alma işlemini gerçekleştirmek istediğinize emin misiniz ?') && confirm('Ödeme yapılacak son kararınız mı ?')" value="Alışverişi Tamamla"></td>
                    </form>


@endsection
