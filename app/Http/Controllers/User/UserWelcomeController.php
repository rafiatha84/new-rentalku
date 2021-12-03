<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Kategori;
use App\Models\Slider;

class UserWelcomeController extends Controller
{
    public function welcome()
    {
        $kategoris = Kategori::get();
        $kendaraan_populer = Kendaraan::withAvg('ratingKendaraan', 'jumlah_bintang')->orderBy('rating_kendaraan_avg_jumlah_bintang', 'desc')->with('kategori','ratingKendaraan')->skip(0)->take(3)->get();
        $sliders = Slider::orderBy('created_at','DESC')->get();
        return view('welcome',[
            'kendaraans' => $kendaraan_populer,
            'sliders' => $sliders,
            'kategoris' => $kategoris
        ]);
    }
}
