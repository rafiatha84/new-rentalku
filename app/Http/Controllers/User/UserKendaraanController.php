<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\RatingKendaraan;
use App\Models\RatingUser;
use App\Models\Kategori;
use App\Models\User;

class UserKendaraanController extends Controller
{
    public function index(){

    }

    public function search(Request $request){
        $kategoris = Kategori::get();
        $currentURL = $request->fullUrl();
        $kendaraans = Kendaraan::with('kategori')->withAvg('ratingKendaraan', 'jumlah_bintang')->paginate(6);
        $q = $request->q;
        if($q != null && $q != ""){
            $kendaraans = Kendaraan::with('kategori')->where('name', 'like', '%'.$q.'%')->withAvg('ratingKendaraan', 'jumlah_bintang')->paginate(6);
        }
        if(isset($request->kategori)){
            $kategorisQuery = $request->kategori;
            $kategori = Kategori::select('id')->whereIn('name',$kategorisQuery)->get();
            $kategoriArray = Array();
            foreach($kategori as $k){
                array_push($kategoriArray,$k->id);
            }
            // dd($kategoriArray);
            $kendaraans = Kendaraan::with('kategori')->whereIN('kategori_id',$kategoriArray)->withAvg('ratingKendaraan', 'jumlah_bintang')->paginate(6);
            if($q != null && $q != ""){
                $kendaraans = Kendaraan::with('kategori')->whereIN('kategori_id',$kategoriArray)->withAvg('ratingKendaraan', 'jumlah_bintang')->orWhere('name', 'like', '%'.$q.'%')->paginate(6);
            }
        }

        $kendaraans->setPath($currentURL);
        dd($kendaraans);
        return view('user.search',[
            "kendaraans" => $kendaraans,
            "kategorisQuery" => $kategorisQuery,
            "kategoris" => $kategoris
        ]);
    }

    public function detail($kendaraan_id){
        $kendaraan = Kendaraan::withAvg('ratingKendaraan', 'jumlah_bintang')->findOrfail($kendaraan_id);
        // dd($kendaraan);
        return view('user.detail-produk',["kendaraan" => $kendaraan]);
    }

    public function ulasan($kendaraan_id){
        $kendaraan = Kendaraan::with('ratingKendaraan.user')->withAvg('ratingKendaraan', 'jumlah_bintang')->findOrfail($kendaraan_id);
        // dd($kendaraan->ratingKendaraan[0]->user->name);
        return view('user.detail-produk-ulasan',["kendaraan" => $kendaraan]);
    }

    public function ulasan_pemilik($pemilik_id){
        $pemilik = User::with('ratingUser.user')->withAvg('ratingUser', 'jumlah_bintang')->findOrfail($pemilik_id);
        // dd($pemilik);
        return view('user.detail-produk-ulasan-pemilik',["pemilik" => $pemilik]);
    }
}
