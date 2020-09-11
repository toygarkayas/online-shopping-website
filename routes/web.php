<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/','front\HomeController@index');
Route::get('/admin','admin\HomeController@index');
Route::get('/satici','satici\HomeController@index');
//Login İşlemleri
Route::get('admin/login','admin\LoginController@index')->name('admin.login');
Route::get('admin/logout','admin\LoginController@logout')->name('admin.logout');
Route::post('admin/login','admin\LoginController@login')->name('admin.login');
Route::get('satici/login','satici\LoginController@index')->name('satici.login');
Route::get('satici/logout','satici\LoginController@logout')->name('satici.logout');
Route::post('satici/login','satici\LoginController@login')->name('satici.login');
Route::get('satici/register','satici\LoginController@register_form')->name('satici.register');
Route::post('satici/register','satici\LoginController@register_save')->name('satici.register');
Route::get('login','front\LoginController@login_form')->name('front.login');
Route::get('logout','front\LoginController@logout')->name('front.logout');
Route::post('login','front\LoginController@login')->name('front.login');
Route::get('register','front\LoginController@register_form')->name('front.register');
Route::post('register','front\LoginController@register_save')->name('front.register');



//Admin işlemleri
Route::get('admin/urunler','admin\UrunController@index');
Route::get('admin/istekler','admin\UrunController@istekler');
Route::get('admin/istatistikler','admin\UrunController@istatistikler');
Route::get('admin/istatistikgoruntule/{id}','admin\UrunController@istatistikgoruntule');
Route::get('admin/onayistekler','admin\UrunController@onayistekler');
Route::get('admin/redistekler','admin\UrunController@redistekler');
Route::get('admin/istek/onay/{id}','admin\UrunController@onay');
Route::get('admin/istek/red/{id}','admin\UrunController@red');
Route::get('admin/urun/edit/{id}','admin\UrunController@edit');
Route::get('admin/urun/del/{id}','admin\UrunController@destroy');
Route::get('admin/urun/show/{id}','admin\UrunController@show');
Route::post('admin/urun/save/{id}','admin\UrunController@create');
Route::post('admin/urun/update/{id}','admin\UrunController@update');
Route::get('/admin/ayarlar','admin\HomeController@settings');
Route::post('/admin/updatesettings/{id}','admin\HomeController@updatesettings');
Route::get('admin/mesajyazform/{id}','admin\HomeController@mesajyazform');
Route::post('admin/mesajyolla/{id}/{id2}','admin\HomeController@mesajyolla');
Route::get('admin/gonderilenmesajlar','admin\HomeController@gonderilenmesajlar');
Route::get('admin/alinanmesajlar','admin\HomeController@alinanmesajlar');
Route::get('admin/mesajsil/{id}','admin\HomeController@mesajsil');


//Satici işlemleri
Route::get('satici/satistakiurunler','satici\SaticiController@index');
Route::get('satici/silinmisurunler','satici\SaticiController@silinmis');
Route::get('satici/istekler','satici\SaticiController@istekler');
Route::get('satici/istekolustur','satici\SaticiController@istekolustur');
Route::get('satici/istekguncelle/{id}','satici\SaticiController@istekguncelle');
Route::post('satici/istekbilgisiguncelle/{id}','satici\SaticiController@istekbilgisiguncelle');
Route::get('satici/isteksil/{id}','satici\SaticiController@isteksil');
Route::post('satici/istekyolla','satici\SaticiController@istekyolla');
Route::get('satici/urunguncelle/{id}','satici\SaticiController@urunguncelle');
Route::post('satici/urunbilgisiguncelle/{id}','satici\SaticiController@urunbilgisiguncelle');
Route::get('satici/onaylanacaksatislar','satici\SaticiController@satislar');
Route::get('satici/onaylanmissatislar','satici\SaticiController@onaylanmissatislar');
Route::get('satici/urunkaldir/{id}','satici\SaticiController@urunkaldir');
Route::get('satici/yorumlar','satici\SaticiController@yorumlar');
Route::get('satici/galeri/{id}','satici\SaticiController@galeri');
Route::get('satici/galerigoruntule/{id}','satici\SaticiController@galerigoruntule');
Route::post('satici/galeri/{id}','satici\SaticiController@galeriekle');
Route::get('satici/galerisil/{id}','satici\SaticiController@galerisil');
Route::get('satici/bizeyazin','satici\SaticiController@bizeyazinform');
Route::post('satici/bizeyazin/{id}','satici\SaticiController@bizeyazinyolla');
Route::get('satici/gonderilenmesajlar','satici\SaticiController@gonderilenmesajlar');
Route::get('satici/alinanmesajlar','satici\SaticiController@alinanmesajlar');
Route::get('satici/mesajcevaplama/{id}','satici\SaticiController@mesajcevaplamaform');
Route::post('satici/mesajyolla/{id}/{id2}','satici\SaticiController@mesajyolla');
Route::get('satici/satisonay/{id}','satici\SaticiController@satisonay');
Route::get('satici/satisiptal/{id}','satici\SaticiController@satisiptal');


//Müşteri İşlemleri
Route::get('urun/{id}','front\HomeController@urundetay');
Route::get('tur/{id}','front\HomeController@tur');
Route::get('user','front\UserController@index');
Route::get('hakkimizda','front\HomeController@hakkimizda');
Route::get('iletisim','front\HomeController@iletisim');
Route::get('indirimdekiler','front\HomeController@indirimdekiler');
Route::get('bizeyazin','front\HomeController@bizeyazinform');
Route::post('bizeyazin/{id}','front\HomeController@bizeyazinyolla');
Route::get('gonderilenmesajlar','front\HomeController@gonderilenmesajlar');
Route::get('alinanmesajlar','front\HomeController@alinanmesajlar');
Route::get('mesajcevaplama/{id}','front\HomeController@mesajcevaplamaform');
Route::post('mesajyolla/{id}/{id2}','front\HomeController@mesajyolla');
Route::post('sepeteekle','front\UserController@sepeteekle');
Route::get('sepetim','front\UserController@sepetim');
Route::get('sepettencikar/{id}','front\UserController@sepettencikar');
Route::post('alisverisitamamla','front\UserController@alisverisitamamla');
Route::post('satinal','front\UserController@satinal');
Route::get('siparislerim','front\UserController@siparislerim');
Route::get('degerlendirmeformu/{id}','front\UserController@degerlendirmeformu');
Route::post('degerlendir/{id}','front\UserController@degerlendir');
Route::get('smesajcevaplama/{id}','front\HomeController@smesajcevaplamaform');
Route::post('smesajyolla/{id}/{id2}','front\HomeController@smesajyolla');








//Auth::routes();

Route::get('/home', 'admin\HomeController@index')->name('home');
