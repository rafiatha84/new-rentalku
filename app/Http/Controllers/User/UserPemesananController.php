<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Dompet;
use App\Models\Transaksi;
use Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class UserPemesananController extends Controller
{
    public function index(){

    }

    public function create_form($kendaraan_id){
        $kendaraan = Kendaraan::with('user.pengemudi.user.ratingUser','kategori')->findOrFail($kendaraan_id);
        // dd($kendaraan->user->pengemudi[0]->user->ratingUser->count());
        $dompet = Dompet::where('user_id',Auth::user()->id)->firstOrFail();
        // dd($dompet);
        return view('user.pemesanan-create',[
            'kendaraan' => $kendaraan,
            'dompet' => $dompet
        ]);
    }

    public function create(){
        return 'ok';
    }

    public function pesananku(){
        $transaksi= Transaksi::with('kendaraan.kategori','kendaraan.user','pengemudiTransaksi')->where('user_id',Auth::user()->id)->where('status','Proses')->get();
        // dd($transaksi);
        // dd($transaksi[1]->chat_room());
        return view('user.pesananku',['transaksis'=>$transaksi]);
    }

    public function pesananku_selesai()
    {
        $transaksi= Transaksi::with('kendaraan.kategori','kendaraan.user','pengemudiTransaksi','ratingKendaraan')->where('user_id',Auth::user()->id)->where('status','Selesai')->get();
        // dd($transaksi[0]->ratingKendaraan);
        // dd($transaksi[1]->chat_room());
        return view('user.pesananku-selesai',['transaksis'=>$transaksi]);
    }

    public function detail($pemesanan_id)
    {
        $transaksi = Transaksi::with('kendaraan','pengemudiTransaksi.pengemudi.user')->findOrFail($pemesanan_id);
        // dd($transaksi->kategori);
        return view('user.pemesanan-detail',[
            'transaksi' => $transaksi
        ]);
    }
}
