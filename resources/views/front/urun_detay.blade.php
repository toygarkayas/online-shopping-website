@extends('layouts.front.fmaster')

@section('title','Ürün Detayları')
@section('keywords','')
@section('description','')

@section('sidebar')
    @include('front.fsidebar')
@endsection
@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Anasayfa</a> <span class="divider">/</span></li>
            <li><a href="{{url('/')}}/urunler">Ürünler</a> <span class="divider">/</span></li>
            <li class="active">{{$urun[0]->turu}}</li>
        </ul>
        <div class="well well-small">
            <div class="row-fluid">
                <div class="span5">
                    <div id="myCarousel" class="carousel slide cntr">
                        <div class="carousel-inner">
                            @if(\Session::has('success'))
                                <div class="alert alert-success">
                                    <p>{{\Session::get('success')}}</p>
                                </div><br/>
                            @endif
                            <div class="item active">
                                <a href="#"> <img src="{{url('/')}}/userfiles/{{$urun[0]->resim}}" alt="" style="width:100%"></a>
                            </div>
                            @foreach($resimler as $rs)
                                <div class="item">
                                    <a href="#"> <img src="{{url('/')}}/userfiles/{{$rs->resim}}" alt="" style="width:100%"></a>
                                </div>
                            @endforeach
                        </div>
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                    </div>
                </div>
                <div class="span7">
                    <h3>{{$urun[0]->urun_adi}}</h3>
                    <hr class="soft"/>

                    <form class="form-horizontal qtyFrm" method="post" action="{{url('/')}}/sepeteekle">
                        @csrf
                        <input type="hidden" name="urunid" value="{{$urun[0]->Id}}">
                        <div class="control-group">
                            <label class="control-label"><span>Fiyat :{{$urun[0]->fiyat}} TL</span></label>
                            <div class="controls">
                               Adet: <input type="number" name="miktar" value="1" class="span6" placeholder="Miktar" min="1" max="{{$urun[0]->stok}}">
                            </div>
                        </div>
                        <h4>Stokta bu üründen {{$urun[0]->stok}} adet mevcut.</h4>
                            <button type="submit" class="shopBtn"><span class=" icon-shopping-cart"></span>Sepete Ekle</button>
                    </form>
                </div>
            </div>
            <hr class="softn clr"/>


            <ul id="productDetail" class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab">Ürün Açıklaması</a></li>
                <li class=""><a href="#profile" data-toggle="tab">Ürüne Yapılan Değerlendirmeler</a></li>
            </ul>
            <div id="myTabContent" class="tab-content tabWrapper">
                <div class="tab-pane fade active in" id="home">
                    <h4>Ürün Bilgisi</h4>
                    <p>{{$urun[0]->description}}</p>
                </div>
                <div class="tab-pane fade" id="profile">
                    @foreach($yorumlar as $yorum)
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th>Puan</th>
                                <th>Yorum</th>
                            </tr>
                            <tr>
                                <td>{{$yorum->yildiz}}</td>
                                <td>{{$yorum->yorum}}</td>
                            </tr>
                            </tbody></table>
                    @endforeach
                </div>
                </div>
                </div>
            </div>

        </div>
    </div>
    </div> <!-- Body wrapper -->
@endsection
