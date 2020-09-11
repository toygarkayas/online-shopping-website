@extends('Layouts.admin.amaster')

@section('title','Ayarlar')

@section('content')
    <section class="content-header">
        <h1>Site Ayarları</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i>Anasayfa</a></li>
            <li><a href="#"><i class="fa fa-dashboard"></i>Ayarlar</a></li>
        </ol>
    </section>
    @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div><br/>
    @endif
    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Genel</a></li>
                    <li><a href="#tab_2" data-toggle="tab">SMTP Ayarları</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Hakkımızda Sayfası</a></li>
                    <li><a href="#tab_4" data-toggle="tab">İletişim</a></li>
                </ul>
                <form method="post" action="{{url('/')}}/admin/updatesettings/{{$site[0]->Id}}">
                @csrf
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Site Adı</label>
                            <div class="col-sm-10"><input type="text" name="adi" value="{{$site[0]->adi}}" class="form-control"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Keywords</label>
                            <div class="col-sm-10"><input type="text" name="keywords" value="{{$site[0]->keywords}}" class="form-control"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10"><input type="text" name="description" value="{{$site[0]->description}}" class="form-control"></div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">SMTP Email</label>
                            <div class="col-sm-10"><input type="text" name="smtpemail" value="{{$site[0]->smtpemail}}" class="form-control"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">SMTP Server</label>
                            <div class="col-sm-10"><input type="text" name="smtpserver" value="{{$site[0]->smtpserver}}" class="form-control"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">SMTP Port</label>
                            <div class="col-sm-10"><input type="text" name="smtpport" value="{{$site[0]->smtpport}}" class="form-control"></div>
                        </div>
                    </div>

                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Adres</label>
                            <div class="col-sm-10"><input type="text" name="adres" value="{{$site[0]->adres}}" class="form-control"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Telefon</label>
                            <div class="col-sm-10"><input type="text" name="tel" value="{{$site[0]->tel}}" class="form-control"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10"><input type="text" name="email" value="{{$site[0]->email}}" class="form-control"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Şehir</label>
                            <div class="col-sm-10"><input type="text" name="sehir" value="{{$site[0]->sehir}}" class="form-control"></div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab_4">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Hakkımızda</label>
                            <div class="col-sm-10"><input type="text" name="hakkimizda" value="{{$site[0]->hakkimizda}}" class="form-control"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Facebook</label>
                            <div class="col-sm-10"><input type="text" name="facebook" value="{{$site[0]->facebook}}" class="form-control"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Twitter</label>
                            <div class="col-sm-10"><input type="text" name="twitter" value="{{$site[0]->twitter}}" class="form-control"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Instagram</label>
                            <div class="col-sm-10"><input type="text" name="instagram" value="{{$site[0]->instagram}}" class="form-control"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Youtube</label>
                            <div class="col-sm-10"><input type="text" name="youtube" value="{{$site[0]->youtube}}" class="form-control"></div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <button type="submit">Güncelle</button>
                </form>
                    <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
    </div>
@endsection
