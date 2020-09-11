<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Admin İşlemleri</li>

            <li>
                <a href="{{url('/')}}/admin">
                    <i class="fa fa-th"></i> <span>Anasayfa</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Ürün İşlemleri</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('/')}}/admin/urunler"><i class="fa fa-circle-o"></i> Ürün Listesi</a></li>
                    <li><a href="{{url('/')}}/admin/istekler"><i class="fa fa-circle-o"></i> Bekleyen Satıcı İstekleri</a></li>
                    <li><a href="{{url('/')}}/admin/onayistekler"><i class="fa fa-circle-o"></i> Onaylanan Satıcı İstekleri</a></li>
                    <li><a href="{{url('/')}}/admin/redistekler"><i class="fa fa-circle-o"></i> Reddedilen Satıcı İstekleri</a></li>
                    <li><a href="{{url('/')}}/admin/istatistikler"><i class="fa fa-circle-o"></i> İstatistikler</a></li>
                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Mesaj İşlemleri</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('/')}}/admin/alinanmesajlar"><i class="fa fa-circle-o"></i>Alınan Mesajlarım</a></li>
                    <li><a href="{{url('/')}}/admin/gonderilenmesajlar"><i class="fa fa-circle-o"></i>Gönderilen Mesajlarım</a></li>
                </ul>
            </li>

            <li>
                <a href="{{url('/')}}/admin/ayarlar">
                    <i class="fa fa-cog"></i> <span>Ayarlar</span>
                </a>
            </li>

            </ul>
    </section>
    <!-- /.sidebar -->
</aside>

