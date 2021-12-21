<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kendaraan;
use App\Models\Slider;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\Lokasi;

class UserDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kategoris = Kategori::get();
        $lokasis = Lokasi::get();
        $transaksi = Transaksi::where('status','Proses')->get();
        $unitIdArray = Array(0);
        foreach($transaksi as $t){array_push($unitIdArray,$t->kendaraan_id);};
        $kendaraan_populer = Kendaraan::withAvg('ratingKendaraan', 'jumlah_bintang')->orderBy('rating_kendaraan_avg_jumlah_bintang', 'desc')->with('kategori','ratingKendaraan')->whereNotIn('id',$unitIdArray)->skip(0)->take(3)->get();
        $sliders = Slider::orderBy('created_at','DESC')->get();
        return view('user.dashboard',[
            'kendaraans' => $kendaraan_populer,
            'sliders' => $sliders,
            'kategoris' => $kategoris,
            'lokasis' => $lokasis
        ]);
    }
    public function welcome()
    {
        $kategoris = Kategori::get();
        $transaksi = Transaksi::where('status','Proses')->get();
        $unitIdArray = Array(0);
        foreach($transaksi as $t){array_push($unitIdArray,$t->kendaraan_id);};
        $kendaraan_populer = Kendaraan::withAvg('ratingKendaraan', 'jumlah_bintang')->orderBy('rating_kendaraan_avg_jumlah_bintang', 'desc')->with('kategori','ratingKendaraan')->whereNotIn('id',$unitIdArray)->skip(0)->take(3)->get();
        $sliders = Slider::orderBy('created_at','DESC')->get();
        return view('welcome',[
            'kendaraans' => $kendaraan_populer,
            'sliders' => $sliders,
            'kategoris' => $kategoris
        ]);
    }
    public function pemilik(Request $request)
    {
        //if(Auth::check()){
            return view('user.pemilik.dashboard');
        //}
  
        //return redirect("login")->with('status','Anda tidak diizinkan untuk mengakses');
    }
}
