<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">İşlemler</li>

            <li>
                <a href="{{url('/')}}/satici">
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
                    <li><a href="{{url('/')}}/satici/satistakiurunler"><i class="fa fa-circle-o"></i>Satıştaki Ürünlerim</a></li>
                    <li><a href="{{url('/')}}/satici/istekler"><i class="fa fa-circle-o"></i>İsteklerim</a></li>
                    <li><a href="{{url('/')}}/satici/istekolustur"><i class="fa fa-circle-o"></i>İstek Oluştur</a></li>
                    <li><a href="{{url('/')}}/satici/onaylanacaksatislar"><i class="fa fa-circle-o"></i>Onaylanacak Satışlar</a></li>
                    <li><a href="{{url('/')}}/satici/onaylanmissatislar"><i class="fa fa-circle-o"></i>Onaylanmış Satışlar</a></li>
                    <li><a href="{{url('/')}}/satici/yorumlar"><i class="fa fa-circle-o"></i>Ürünlerime Yapılan Yorumlar</a></li>
                    <li><a href="{{url('/')}}/satici/silinmisurunler"><i class="fa fa-circle-o"></i>Satıştan Kaldırılmış Ürünlerim</a></li>
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
                    <li><a href="{{url('/')}}/satici/alinanmesajlar"><i class="fa fa-circle-o"></i>Alınan Mesajlarım</a></li>
                    <li><a href="{{url('/')}}/satici/gonderilenmesajlar"><i class="fa fa-circle-o"></i>Gönderilen Mesajlarım</a></li>
                    <li><a href="{{url('/')}}/satici/bizeyazin"><i class="fa fa-circle-o"></i>Bize Yazın</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

