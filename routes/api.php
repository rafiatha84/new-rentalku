<?php

use App\Models\Pengemudi;
use Illuminate\Http\Request;
use App\Models\TransaksiDompet;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MapsController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ArtikelController;
use App\Http\Controllers\API\DompetkuController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\KendaraanController;
use App\Http\Controllers\API\PengemudiController;
use App\Http\Controllers\API\TransaksiController;
use App\Http\Controllers\API\RatingKedaraanController;
use App\Http\Controllers\API\RatingUserController;
use App\Http\Controllers\API\UserMessageController;
use App\Http\Controllers\API\RatingKendaraanController;
use App\Http\Controllers\API\SliderController;
use App\Http\Controllers\API\TransaksiDompetController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//API route for register new user
Route::post('/register', [AuthController::class, 'register'])->name('api.register');
//API route for login user
Route::post('/register/pemilik', [AuthController::class, 'register_pemilik'])->name('api.register.pemilik');
Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::group(['prefix' => 'auth', 'middleware' => ['auth:sanctum']], function() {
    Route::get('/user',[AuthController::class,'user'])->name('api.user');
    // manggil controller sesuai bawaan laravel 8
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
    // manggil controller dengan mengubah namespace di RouteServiceProvider.php biar bisa kayak versi2 sebelumnya
    Route::post('/logoutall',[AuthController::class, 'logoutall'])->name('api.logoutall');
});

Route::group(['prefix' => 'message'], function () {
    Route::get('/all',[UserMessageController::class, 'get_chat_room'])->name('api.message.getall');
    Route::get('/room/{user_id}',[UserMessageController::class, 'get_room_by_id'])->name('api.message.byid');
    Route::get('/room/message/{chat_room_id}',[UserMessageController::class, 'get_message_by_room'])->name('api.message.byroom');
    Route::post('/send',[UserMessageController::class, 'send_message'])->name('api.message.send');
});

//Kendaraan
Route::get('/kendaraan', [KendaraanController::class, 'index'])->name('api.kendaraan');
Route::get('/kendaraan/most', [KendaraanController::class, 'most'])->name('api.kendaraan.most');
Route::get('/kendaraan/{id}', [KendaraanController::class, 'showId'])->name('api.kendaraan.showId');
Route::get('/kendaraan/owner/{user_id}',[KendaraanController::class, 'showByOwner'])->name('api.kendaraan.showByOwner');
Route::post('/kendaraan/store', [KendaraanController::class, 'store'])->name('api.kendaraan.store');
Route::post('/kendaraan/update/{id}', [KendaraanController::class, 'update'])->name('api.kendaraan.update');
Route::delete('/kendaraan/destroy/{id}', [KendaraanController::class, 'destroy'])->name('api.kendaraan.destroy');
Route::get('/search',[KendaraanController::class,'search'])->name('api.kendaraan.search');

//Pengemudi
// Route::get('/pengemudi', [PengemudiController::class, 'index'])->name('api.pengemudi.index');
// Route::get('/pengemudi/{id}', [PengemudiController::class, 'show'])->name('api.pengemudi.show');
// Route::get('/pengemudi/owner/{owner_id}',[PengemudiController::class, 'show_by_owner'])->name('api.pengemudi.show_by_owner');
// Route::get('/pengemudi/create', [PengemudiController::class, 'store'])->name('api.pengemudi.store');
// Route::get('/pengemudi/update/{pengemudi_id}', [PengemudiController::class, 'update'])->name('api.pengemudi.update');
// Route::delete('/pengemudi/destroy/{id}', [PengemudiController::class, 'destroy'])->name('api.pengemudi.destroy');


//artikel
Route::get('/artikel', [ArtikelController::class, 'index'])->name('api.artikel');
Route::post('/artikel/store', [ArtikelController::class, 'store'])->name('api.artikel.store');
Route::post('/artikel/update/{id}', [ArtikelController::class, 'update'])->name('api.artikel.update');
Route::delete('/artikel/destroy/{id}', [ArtikelController::class, 'destroy'])->name('api.artikel.destroy');


//User
Route::get('/user', [UserController::class, 'index'])->name('api.user');
Route::get('/user/profil/{id}', [UserController::class, 'show'])->name('api.user.show');
Route::post('/user/edit',[UserController::class, 'edit_action'])->name('api.user.edit.action');
// Route::post('/update/kota',[UserController::class,'updateKota'])->name('api.update.kota');

//pengemudi
Route::get('/pengemudi/show/{transaksi_id}',[PengemudiController::class,'showByTransaksi'])->name('api.pengemudi.showTransaksiId');
Route::get('/pengemudi/all/showbypemilik/{owner_id}',[PengemudiController::class,'showByOwner'])->name('api.pengemudi.showByOwner');
Route::post('/pengemudi/store', [PengemudiController::class, 'store'])->name('api.pengemudi.store');
Route::post('/pengemudi/create', [PengemudiController::class, 'create'])->name('api.pengemudi.create');
Route::post('/pengemudi/update/{id}', [PengemudiController::class, 'update'])->name('api.pengemudi.update');
Route::post('/pengemudi/delete/{pengemudi_id}', [PengemudiController::class, 'destroy'])->name('api.pengemudi.destroy');

//maps
Route::get('/maps/lat_to_address', [MapsController::class, 'latToAddress'])->name('api.maps.lat');
Route::get('/maps/address_to_lat', [MapsController::class, 'addressToLat'])->name('api.maps.long');
Route::get('/maps/track/{kendaraan_id}', [MapsController::class, 'kendaraanTrack'])->name('api.maps.track');
Route::get('/maps/search', [MapsController::class, 'search_address'])->name('api.maps.search');
Route::get('/maps/update',[MapsController::class, 'update_maps'])->name('api.maps.update');
Route::post('/maps/update',[MapsController::class, 'update_maps'])->name('api.maps.update');

//kategori
Route::get('/kategori', [KategoriController::class, 'index'])->name('api.kategori.show');
Route::get('/kategori/{id}', [KategoriController::class, 'showId'])->name('api.kategori.showId');
Route::post('/kategori/create', [KategoriController::class, 'store'])->name('api.kategori.create');
Route::post('/kategori/update/{id}', [KategoriController::class, 'update'])->name('api.kategori.update');
Route::delete('/kategori/delete/{kategori_id}', [KategoriController::class, 'destroy'])->name('api.kategori.destroy');
Route::post('/update/kota',[KategoriController::class,'updateKota'])->name('api.update.kota');
//Rekeming
Route::get('/rekening',[DompetkuCOntroller::class, 'rekening'])->name('api.rekening');

//Dompetku
Route::get('/dompetku/{user_id}', [DompetkuController::class, 'show'])->name('api.dompetku.show');
Route::get('/dompetku/saldo/{user_id}', [TransaksiDompetController::class, 'saldoDompet'])->name('transaksi.dompet');
Route::post('/dompetku/update/{user_id}', [DompetkuController::class, 'update'])->name('api.dompetku.update');
Route::post('/dompetku/topup/',[TransaksiDompetController::class, 'topup'])->name('api.dompetku.topup');
Route::post('/dompetku/penarikan',[TransaksiDompetController::class, 'penarikan'])->name('api.dompetku.penarikan');
Route::post('/dompetku/konfirmasi/topup/{transaksi_dompet_id}',[TransaksiDompetController::class,'konfirmasi_topup'])->name('api.dompetku.topup.konfirmasi');
Route::post('/dompetku/konfirmasi/penarikan/{transaksi_dompet_id}',[TransaksiDompetController::class,'konfirmasi_penarikan'])->name('api.dompetku.penarikan.konfirmasi');

//Transaksi Dompet
Route::get('/transaksi_dompet/show/{id}', [TransaksiDompetController::class, 'show'])->name('api.transaksiDompet.show');
Route::get('/transaksi_dompet/{id}', [TransaksiDompetController::class, 'showId'])->name('api.transaksiDompet.showId');
Route::post('/transaksi_dompet/create', [TransaksiDompetController::class, 'store'])->name('api.transaksiDompet.create');
Route::post('/transaksi_dompet/update/{id}', [TransaksiDompetController::class, 'update'])->name('api.transaksiDompet.update');
Route::delete('/transaksi_dompet/delete/{dompet_id}', [TransaksiDompetController::class, 'destroy'])->name('api.transaksiDompet.destroy');

//Transaksi
Route::get('/form/transaksi/{kendaraan_id}',[TransaksiController::class, 'create'])->name('api.transaksi.form');
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('api.transaksi.index');
Route::post('/transaksi/create', [TransaksiController::class, 'store'])->name('api.transaksi.create');
Route::get('transaksi/{transaksi_id}', [TransaksiController::class, 'showId'])->name('api.transaksi.showId');
Route::post('/transaksi/update/{transaksi_id}', [TransaksiController::class, 'update'])->name('api.transaksi.update');
Route::delete('/transaksi/delete/{transaksi_id}', [TransaksiController::class, 'destroy'])->name('api.transaksi.destroy');
Route::get('transaksi/show/{user_id}', [TransaksiController::class, 'show'])->name('api.transaksi.show');
Route::get('transaksi/show/selesai/{user_id}', [TransaksiController::class, 'show_selesai'])->name('api.transaksi.show.selesai');

Route::get('transaksi/show/byowner/{owner_id}', [TransaksiController::class, 'show_byowner'])->name('api.transaksi.show.byowner');
Route::get('transaksi/show/byowner/selesai/{owner_id}', [TransaksiController::class, 'show_selesai_byowner'])->name('api.transaksi.show.selesai.byowner');

Route::get('transaksi/show/bypengemudi/{pengemudi_id}', [TransaksiController::class, 'show_bypengemudi'])->name('api.transaksi.show.bypengemudi');
Route::get('transaksi/show/bypengemudi/selesai/{pengemudi_id}', [TransaksiController::class, 'show_selesai_bypengemudi'])->name('api.transaksi.show.selesai.bypengemudi');

Route::post('transaksi/selesai/{transaksi_id}',[TransaksiController::class, 'update_selesai'])->name('api.transaksi.update.selesai');
Route::post('transaksi/selesai/action/{pemesanan_id}',[TransaksiController::class, 'selesai_action'])->name('api.pesanan.selesai.action');
Route::post('transaksi/create/rating',[TransaksiController::class,'create_rating'])->name("api.transaksi.rating");
//Rating Kendaraan
Route::get('rating/kendaraan/{rating_id}', [RatingKendaraanController::class, 'showId'])->name('api.ratingKendaraan.showId');
Route::get('rating/kendaraan/all/{kendaraan_id}', [RatingKendaraanController::class, 'show'])->name('api.ratingKendaraan.show');
Route::post('/rating/kendaraan/create', [RatingKendaraanController::class, 'store'])->name('api.ratingKendaraan.create');
Route::post('/rating/kendaraan/update/{id}', [RatingKendaraanController::class, 'update'])->name('api.ratingKendaraam.update');
Route::delete('rating/kendaraan/delete/{rating_id}', [RatingKendaraanController::class, 'destroy'])->name('api.ratingKendaraan.destroy');

//Rating User
Route::get('rating/user/{rating_id}', [RatingUserController::class, 'showId'])->name('api.ratingUser.showId');
Route::get('rating/user/all/{kendaraan_id}', [RatingUserController::class, 'show'])->name('api.ratingUser.show');
Route::get('rating/user/all/byuser/{user_id}', [RatingUserController::class, 'show_byuser'])->name('api.ratingUser.show.byuserid');
Route::post('/rating/user/create', [RatingUserController::class, 'store'])->name('api.ratingUser.create');
Route::post('/rating/user/update/{id}', [RatingUserController::class, 'update'])->name('api.ratingUser.update');
Route::delete('rating/user/delete/{rating_id}', [RatingUserController::class, 'destroy'])->name('api.ratingUser.destroy');


//Profile
Route::post('user/profile/update/{user_id}', [UserController::class, 'update'])->name('user.update');

//Slider
Route::get('slider', [SliderController::class, 'index'])->name('slider.index');
Route::post('slider/create', [SliderController::class, 'store'])->name('slider.create');
Route::post('slider/update/{id}', [SliderController::class, 'update'])->name('slider.update');
Route::delete('slider/delete/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');
