@extends('layouts.admin.amaster')

@section('title','Alınan Mesajlar')
@section('keywords','')
@section('description','')

@section('content')
    @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div><br/>
    @endif
    <h1>
        Alınan Mesajlar
    </h1>
    <div class="box">
    <div class="box-body">
        <table class="table table-bordered">
            <tbody><tr>
                <th>Yollayan ID</th>
                <th>Yollayan Rolü</th>
                <th>Konu</th>
                <th>Tarih</th>
                <th>Mesaj</th>
                <th>Cevapla</th>
                <th>Sil</th>
            </tr>

            @foreach($mesajlar as $mesaj)
                    <tr>
                        <td>{{$mesaj->sender_id}}</td>
                        <td>{{$mesaj->role}}</td>
                        <td>{{$mesaj->subject}}</td>
                        <td>{{$mesaj->tarih}}</td>
                        <td>{{$mesaj->message}}</td>
                        <td>
                            <a href="{{url('/')}}/admin/mesajyazform/{{$mesaj->sender_id}}" class="btn btn-block btn-primary btn-xs">Cevapla</a>
                        </td>
                        <td>
                            <a href="{{url('/')}}/admin/mesajsil/{{$mesaj->Id}}" class="btn btn-block btn-danger btn-xs" onclick="return confirm('Mesajı silmek istediğinize emin misiniz ?') && confirm('Silme işlemi gerçekleştirilecek son kararınız mı ?')">Sil</a>
                        </td>
                    </tr>
            @endforeach
            </tbody></table>
    </div>
    </div>
@endsection
