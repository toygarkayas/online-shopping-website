@extends('layouts.front.fmaster')

@section('title','Sepetim')
@section('keywords','')
@section('description','')

@section('sidebar')
    @include('front.usersidebar')
@endsection

@section('content')
    <hr class="soften">
    <div>
        <h1>Sepetim</h1>
    </div>
    @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div><br/>
    @endif
    <div class="box">
        <div class="box-body">
            <table class="table table-bordered">
                <tbody><tr>
                    <th>Ürün Adi</th>
                    <th>Ürün Resmi</th>
                    <th>Miktar</th>
                    <th>Adet Fiyat</th>
                    <th>Tutar</th>
                    <th>Satıcı Id</th>
                    <th>Ürünü Sepetten Çıkar</th>
                </tr>
                <?php $previous=0; $flag=1;$toplam_tutar=0;?>
                @foreach($sepetler as $key=>$val)
                    <?php
                        if($previous==$sepetler[$key]->urun_id)
                        {
                            $flag=0;
                        }
                        else
                        {
                            $j=1;
                            $adet=$sepetler[$key]->miktar;
                            while($key+$j < count($sepetler) && $sepetler[$key]->urun_id==$sepetler[$key+$j]->urun_id)
                            {
                                $adet=$adet+$sepetler[$key+$j]->miktar;
                                $j++;
                            }
                            $tutar=$adet * $sepetler[$key]->fiyat;
                            $previous=$sepetler[$key]->urun_id;
                            $flag=1;
                            $toplam_tutar+=$tutar;
                        }
                    ?>
                    @if($flag)
                    <tr>
                        <td>{{$sepetler[$key]->urun_adi}}</td>
                        <td><a href="{{url('/')}}/urun/{{$sepetler[$key]->urun_id}}}"><img src="{{url('/')}}/userfiles/{{$sepetler[$key]->resim}}" height="50"></a></td>
                        <td>{{$adet}}</td>
                        <td>{{$sepetler[$key]->fiyat}}</td>
                        <td>{{$tutar}}</td>
                        <td>{{$sepetler[$key]->satici_id}}</td>
                        <td><a href="{{url('/')}}/sepettencikar/{{$sepetler[$key]->urun_id}}" class="btn btn-block btn-danger btn-xs" onclick="confirm('Ürünü sepetten çıkarmak istediğinize emin misiniz ?')">Sepetten Çıkar</a></td>
                    </tr>
                    @endif
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Toplam Tutar:</td>
                    <td>{{$toplam_tutar}}</td>
                    <td></td>
                    <form method="post" action="{{url('/')}}/alisverisitamamla">
                        @csrf
                        <td><input type="submit" class="btn btn-success" value="Alışverişi Tamamla"></td>
                        <input type="hidden" name="toplam" value="<?php echo $toplam_tutar; ?>">
                    </form>
                </tr>
                </tbody></table>
        </div>
    </div>


@endsection
