@section('content')
    <div class="well well-small">
        <h3>Ürünler</h3>
        <hr class="soften"/>
        <div class="row-fluid">
            <div id="newProductCar" class="carousel slide">
                <div class="carousel-inner">
                    <div class="item active">
                        <ul class="thumbnails">
                            <?php $say=1; ?>
                            @foreach($urunler as $urun)
                            <li class="span3">
                                <div class="thumbnail">
                                    <a class="zoomTool" href="{{url('/')}}/urun/{{$urun->Id}}" title="add to cart"><span class="icon-search"></span> QUICK VIEW</a>
                                    <a href="#" class="tag"></a>
                                    <a href="{{url('/')}}/urun/{{$urun->Id}}"><img src="{{url('/')}}/userfiles/{{$urun->resim}}" alt="bootstrap-ring"></a>
                                </div>
                            </li>
                            <?php
                                $say=$say+1;
                                if($say > 4)
                                {
                                    ?>
                                    </ul>
                                    </div>
                                    <div class="item">
                                        <ul class="thumbnails">
                                        <?php
                                            $say=1;
                                }
                             ?>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <a class="left carousel-control" href="#newProductCar" data-slide="prev">&lsaquo;</a>
                <a class="right carousel-control" href="#newProductCar" data-slide="next">&rsaquo;</a>
            </div>
        </div>
    </div>

    <div class="well well-small">
        <h3>En Çok Satan Ürünler</h3>
        <hr class="soften"/>
        <div class="row-fluid">
            <div id="newProductCar" class="carousel slide">
                <div class="carousel-inner">
                    <div class="item active">
                        <ul class="thumbnails">
                            <?php $say=1; ?>
                            @for($i = 0; $i < 4; $i++)
                                <li class="span3">
                                    <div class="thumbnail">
                                        <a class="zoomTool" href="{{url('/')}}/urun/{{$popular[$i]->Id}}" title="add to cart"><span class="icon-search"></span> QUICK VIEW</a>
                                        <a href="#" class="tag"></a>
                                        <a href="{{url('/')}}/urun/{{$popular[$i]->Id}}"><img src="{{url('/')}}/userfiles/{{$popular[$i]->resim}}" alt="bootstrap-ring"></a>
                                    </div>
                                </li>
                                <?php
                                $say=$say+1;
                                if($say > 4)
                                {
                                ?>
                        </ul>
                    </div>
                    <div class="item">
                        <ul class="thumbnails">
                            <?php
                            $say=1;
                            }
                            ?>
                            @endfor
                        </ul>
                    </div>
                </div>
                <a class="left carousel-control" href="#newProductCar" data-slide="prev">&lsaquo;</a>
                <a class="right carousel-control" href="#newProductCar" data-slide="next">&rsaquo;</a>
            </div>
        </div>
    </div>
@endsection
