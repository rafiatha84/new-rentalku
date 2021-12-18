<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\Auth\NewForgotPasswordController;

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

Route::get('/', [App\Http\Controllers\User\UserWelcomeController::class, 'welcome'])->name('user.welcome');
// Auth::routes();
// Auth user
Auth::routes();
Route::get('login', [UserAuthController::class, 'index'])->name('user.login');
Route::post('login', [UserAuthController::class, 'customLogin'])->name('user.login.action'); 
Route::get('registration', [UserAuthController::class, 'registration'])->name('user.register');
Route::post('registration', [UserAuthController::class, 'customRegistration'])->name('user.register.action'); 
Route::get('logout', [UserAuthController::class, 'logOut'])->name('user.logout');

Route::get('forget-password', [NewForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [NewForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [NewForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [NewForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
//dashboard
Route::get('dashboard', [App\Http\Controllers\User\UserDashboardController::class, 'index'])->name('user.dashboard');
Route::get('profile',[App\Http\Controllers\User\UserProfileController::class,'index'])->name('user.profile');
Route::get('profile/edit',[App\Http\Controllers\User\UserProfileController::class,'edit'])->name('user.profile.edit');
Route::post('profile/edit/action',[App\Http\Controllers\User\UserProfileController::class,'edit_action'])->name('user.profile.edit.action');
Route::get('search',[App\Http\Controllers\User\UserKendaraanController::class,'search'])->name('user.search');

Route::get('detail-produk/{kendaraan_id}',[App\Http\Controllers\User\UserKendaraanController::class, 'detail'])->name('user.detail-produk');
Route::get('detail-produk/{kendaraan_id}/ulasan',[App\Http\Controllers\User\UserKendaraanController::class, 'ulasan'])->name('user.detail-produk.ulasan');
Route::get('detail-produk/ulasan/pemilik/{pemilik_id}',[App\Http\Controllers\User\UserKendaraanController::class, 'ulasan_pemilik'])->name('user.detail-produk.ulasan.pemilik');

Route::get('pemesanan/create/{kendaraan_id}',[App\Http\Controllers\User\UserPemesananController::class, 'create_form'])->name('user.pemesanan.create');
Route::post('pemesanan/create',[App\Http\Controllers\User\UserPemesananController::class, 'create'])->name('user.pemesanan.create.action');
Route::get('pemesanan/{pemesanan_id}',[App\Http\Controllers\User\UserPemesananController::class, 'detail'])->name('user.pemesanan.detail');

// pesananku
Route::get('pesananku',[App\Http\Controllers\User\UserPemesananController::class, 'pesananku'])->name('user.pesananku');
Route::get('pesananku/selesai',[App\Http\Controllers\User\UserPemesananController::class, 'pesananku_selesai'])->name('user.pesananku.selesai');

//Dompetku
Route::get('dompetku/',[App\Http\Controllers\User\UserDompetController::class, 'riwayat'])->name('user.dompetku');
Route::get('dompetku/topup',[App\Http\Controllers\User\UserDompetController::class, 'topup_create'])->name('user.dompetku.topup');
Route::get('dompetku/topup/tutorial',[App\Http\Controllers\User\UserDompetController::class, 'tutorial'])->name('user.dompetku.tutorial');
Route::get('dompetku/topup/{id}',[App\Http\Controllers\User\UserDompetController::class, 'topup_detail'])->name('user.dompetku.topup.detail');

Route::group(['prefix' => 'pemilik'],function(){
    Route::get('register',[App\Http\Controllers\User\PemilikProfileController::class,'register'])->name('pemilik.register');
    Route::post('register/action',[App\Http\Controllers\User\PemilikProfileController::class,'register_action'])->name('pemilik.register.action');
    //dashboard
    Route::get('dashboard', [App\Http\Controllers\User\PemilikDashboardController::class, 'index'])->name('pemilik.dashboard');
    Route::get('profile',[App\Http\Controllers\User\PemilikProfileController::class,'index'])->name('pemilik.profile');
    Route::get('profile/edit',[App\Http\Controllers\User\PemilikProfileController::class,'edit'])->name('pemilik.profile.edit');
    Route::post('profile/edit/action',[App\Http\Controllers\User\PemilikProfileController::class,'edit_action'])->name('pemilik.profile.edit.action');
    Route::get('penilaian-ulasan',[App\Http\Controllers\User\PemilikUlasanController::class, 'ulasan_pemilik'])->name('pemilik.ulasan');
    // pesananku
    Route::get('pesananku',[App\Http\Controllers\User\PemilikPemesananController::class, 'pesananku'])->name('pemilik.pesananku');
    Route::get('pesananku/selesai',[App\Http\Controllers\User\PemilikPemesananController::class, 'pesananku_selesai'])->name('pemilik.pesananku.selesai');
    Route::get('pemesanan/{pemesanan_id}',[App\Http\Controllers\User\PemilikPemesananController::class, 'detail'])->name('pemilik.pemesanan.detail');
    Route::post('kendaraan/selesai/action/{pemesanan_id}',[App\Http\Controllers\User\PemilikPemesananController::class, 'selesai_action'])->name('pemilik.pesanan.selesai.action');

    // lacak mobil
    Route::get('lacak/{kendaraan_id}',[App\Http\Controllers\User\PemilikKendaraanController::class, 'lacak'])->name('pemilik.lacak');
    //Dompetku
    Route::get('dompetku/',[App\Http\Controllers\User\PemilikDompetController::class, 'riwayat'])->name('pemilik.dompetku');
    Route::get('dompetku/penarikan',[App\Http\Controllers\User\PemilikDompetController::class, 'penarikan_create'])->name('pemilik.dompetku.penarikan');
    Route::get('dompetku/topup/tutorial',[App\Http\Controllers\User\PemilikDompetController::class, 'tutorial'])->name('pemilik.dompetku.tutorial');
    Route::get('dompetku/topup/{id}',[App\Http\Controllers\User\PemilikDompetController::class, 'topup_detail'])->name('pemilik.dompetku.topup.detail');

    //Unitku
    Route::get('unitku',[App\Http\Controllers\User\PemilikUnitkuController::class,'index'])->name('pemilik.unitku');
    Route::get('unitku/show/{id_kendaraan}',[App\Http\Controllers\User\PemilikUnitkuController::class,'detail'])->name('pemilik.unitku.detail');
    Route::get('unitku/show/{id_kendaraan}/detail',[App\Http\Controllers\User\PemilikUnitkuController::class, 'ulasan'])->name('pemilik.unitku.ulasan');
    Route::get('unitku/edit/{id_kendaraan}',[App\Http\Controllers\User\PemilikUnitkuController::class,'edit'])->name('pemilik.unitku.edit');
    Route::get('unitku/create',[App\Http\Controllers\User\PemilikUnitkuController::class,'create'])->name('pemilik.unitku.create');

    //Supirku
    Route::get('supirku',[App\Http\Controllers\User\PemilikSupirkuController::class,'index'])->name('pemilik.supirku');
    Route::get('supirku/show/{id_user}',[App\Http\Controllers\User\PemilikSupirkuController::class,'detail'])->name('pemilik.supirku.detail');
    Route::get('supirku/show/{id_user}/detail',[App\Http\Controllers\User\PemilikSupirkuController::class, 'ulasan'])->name('pemilik.supirku.ulasan');
    Route::get('supirku/edit/{id_user}',[App\Http\Controllers\User\PemilikSupirkuController::class,'edit'])->name('pemilik.supirku.edit');
    Route::get('supirku/create',[App\Http\Controllers\User\PemilikSupirkuController::class,'create'])->name('pemilik.supirku.create');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [AdminAuthController::class, 'index'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'customLogin'])->name('admin.login.action'); 
    Route::get('registration', [AdminAuthController::class, 'registration'])->name('admin.register');
    Route::post('registration', [AdminAuthController::class, 'customRegistration'])->name('admin.register.action'); 
    Route::get('logout', [AdminAuthController::class, 'logOut'])->name('admin.logout');

    Route::get('/',[App\Http\Controllers\Admin\AdminDashboardController::class,'index'])->name('admin.dashboard');
    Route::get('topup',[App\Http\Controllers\Admin\AdminDompetTransaksiController::class,'topup'])->name('admin.topup');
    Route::post('topup/create',[App\Http\Controllers\Admin\AdminDompetTransaksiController::class,'topup_create'])->name('admin.topup.create');
    Route::post('topup/konfirmasi/{transaksi_dompet_id}',[App\Http\Controllers\Admin\AdminDompetTransaksiController::class,'konfirmasi_topup'])->name('admin.topup.konfirmasi');

    Route::get('penarikan',[App\Http\Controllers\Admin\AdminDompetTransaksiController::class,'penarikan'])->name('admin.penarikan');
    Route::post('penarikan/create',[App\Http\Controllers\Admin\AdminDompetTransaksiController::class,'penarikan_create'])->name('admin.penarikan.create');
    Route::post('penarikan/konfirmasi/{transaksi_dompet_id}',[App\Http\Controllers\Admin\AdminDompetTransaksiController::class,'konfirmasi_penarikan'])->name('admin.penarikan.konfirmasi');

    Route::get('kendaraan',[App\Http\Controllers\Admin\AdminKendaraanController::class,'index'])->name('admin.kendaraan');
    Route::post('kendaraan/create',[App\Http\Controllers\Admin\AdminKendaraanController::class,'create'])->name('admin.kendaraan.create');
    Route::post('kendaraan/update/{id}',[App\Http\Controllers\Admin\AdminKendaraanController::class,'update'])->name('admin.kendaraan.update');
    Route::post('kendaraan/delete/{id}',[App\Http\Controllers\Admin\AdminKendaraanController::class,'destroy'])->name('admin.kendaraan.delete');
    Route::get('kendaraan/dipesan',[App\Http\Controllers\Admin\AdminKendaraanController::class,'dipesan'])->name('admin.kendaraan.dipesan');
    Route::get('kendaraan/selesai',[App\Http\Controllers\Admin\AdminKendaraanController::class,'selesai'])->name('admin.kendaraan.selesai');
    
    Route::get('artikel',[App\Http\Controllers\Admin\AdminArtikelController::class,'index'])->name('admin.artikel');
    Route::get('artikel/create',[App\Http\Controllers\Admin\AdminArtikelController::class,'create'])->name('admin.artikel.create');
    Route::get('artikel/edit',[App\Http\Controllers\Admin\AdminArtikelController::class,'edit'])->name('admin.artikel.edit');

    Route::get('slider',[App\Http\Controllers\Admin\AdminSliderController::class,'index'])->name('admin.slider');
    Route::post('slider/create',[App\Http\Controllers\Admin\AdminSliderController::class,'create'])->name('admin.slider.create');
    Route::post('slider/delete/{id}',[App\Http\Controllers\Admin\AdminSliderController::class,'destroy'])->name('admin.slider.delete');

    Route::get('kategori',[App\Http\Controllers\Admin\AdminKategoriController::class,'index'])->name('admin.kategori');
    Route::post('kategori/create',[App\Http\Controllers\Admin\AdminKategoriController::class,'create'])->name('admin.kategori.create');
    Route::post('kategori/update/{id}',[App\Http\Controllers\Admin\AdminKategoriController::class,'update'])->name('admin.kategori.update');
    Route::post('kategori/delete/{id}',[App\Http\Controllers\Admin\AdminKategoriController::class,'destroy'])->name('admin.kategori.delete');
    Route::get('kategori/kota',[App\Http\Controllers\Admin\AdminKategoriController::class,'kota'])->name('admin.kategori.kota');
    

    Route::post('/user/create',[App\Http\Controllers\Admin\AdminUserController::class, 'create'])->name('admin.user.create');
    Route::post('/user/{id}/update',[App\Http\Controllers\Admin\AdminUserController::class, 'update'])->name('admin.user.update');
    Route::post('user/{id}/delete', [App\Http\Controllers\Admin\AdminUserController::class, 'delete'])->name('admin.user.delete');
});

