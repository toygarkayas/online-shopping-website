    <div id="sidebar" class="span3">
        <div class="well well-small">
            @if(\Illuminate\Support\Facades\Auth::check())
            Hoşgeldiniz {{Auth::user()->name}}
            <ul class="nav nav-list">
                <li><a href="{{url('/')}}/user/profil/{{Auth::user()->Id}}"><span class="icon-chevron-right"></span>Kullanıcı Profili</a></li>
                <li><a href="{{url('/')}}/siparislerim"><span class="icon-chevron-right"></span>Siparişlerim</a></li>
                <li><a href="{{url('/')}}/sepetim"><span class="icon-chevron-right"></span>Sepetim</a></li>
                <li><a href="{{url('/')}}/gonderilenmesajlar"><span class="icon-chevron-right"></span>Gönderilen Mesajlarım</a></li>
                <li><a href="{{url('/')}}/alinanmesajlar"><span class="icon-chevron-right"></span>Alınan Mesajlarım</a></li>
                <li><a href="{{url('/')}}/user/yorumlar/{{Auth::user()->Id}}"><span class="icon-chevron-right"></span>Yorumlarım</a></li>
                <li><a href="{{url('/')}}/logout" class="btn btn-block btn-xs"><span></span>Çıkış Yap</a></li>
            </ul>
            @endif
        </div>
    </div>
