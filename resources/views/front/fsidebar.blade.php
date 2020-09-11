@section('fsidebar')
<div id="sidebar" class="span3">
    <div class="well well-small">
        <ul class="nav nav-list">
            @foreach($turler as $tur)
                <li><a href="{{url('/')}}/tur/{{$tur->Id}}"><span class="icon-chevron-right"></span>{{$tur->adi}}</a></li>
            @endforeach
        </ul>
    </div>

</div>
    @endsection
