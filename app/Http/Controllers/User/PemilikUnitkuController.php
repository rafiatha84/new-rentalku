<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Kategori;
use Auth;

class PemilikUnitkuController extends Controller
{
    public function index(){
        $kendaraans = Kendaraan::where('user_id',Auth::user()->id)->get();
        // dd($kendaraans);
        return view('pemilik.unitku',[
            'kendaraans' => $kendaraans
        ]);
    }

    public function detail($kendaraan_id)
    {
        $kendaraan = Kendaraan::withAvg('ratingKendaraan', 'jumlah_bintang')->findOrfail($kendaraan_id);
        // dd($kendaraan);
        return view('pemilik.unitku-detail',[
            'kendaraan' => $kendaraan
        ]);
    }

    public function edit($kedaraan_id)
    {
        $kendaraan = Kendaraan::findOrfail($kedaraan_id);
        $kategoris = Kategori::get();
        // dd($kendaraan->kategori->name);
        return view('pemilik.unitku-edit',[
            'kendaraan' => $kendaraan,
            'kategoris' => $kategoris
        ]);
    }

    public function create()
    {
        $kategoris = Kategori::get();
        return view('pemilik.unitku-create',[
            'kategoris' => $kategoris
        ]);
    }

    public function ulasan($kendaraan_id)
    {
        return view('pemilik.unitku-ulasan');
    }
}

