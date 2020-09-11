@extends('layouts.front.fmaster')

@section('title','Gönderilmiş Mesajlar')
@section('keywords','')
@section('description','')

@section('content')
    @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div><br/>
    @endif
    <h1>
        Gönderilen Mesajlar
    </h1>
    <div class="box">
        <div class="box-body">
            <table class="table table-bordered">
                <tbody><tr>
                    <th>Yollanan Kişi ID</th>
                    <th>Yollanan Kişi Rol</th>
                    <th>Konu</th>
                    <th>Tarih</th>
                    <th>Mesaj</th>
                </tr>

                @foreach($mesajlar as $mesaj)
                    <tr>
                        <td>{{$mesaj->receiver_id}}</td>
                        <td>{{$mesaj->role}}</td>
                        <td>{{$mesaj->subject}}</td>
                        <td>{{$mesaj->tarih}}</td>
                        <td>{{$mesaj->message}}</td>
                    </tr>
                @endforeach
                @foreach($admin_mesajlar as $admin_mesaj)
                    <tr>
                        <td>Admin ID</td>
                        <td>Admin</td>
                        <td>{{$admin_mesaj->subject}}</td>
                        <td>{{$admin_mesaj->tarih}}</td>
                        <td>{{$admin_mesaj->message}}</td>
                    </tr>
                @endforeach
                </tbody></table>
        </div>
    </div>
@endsection
