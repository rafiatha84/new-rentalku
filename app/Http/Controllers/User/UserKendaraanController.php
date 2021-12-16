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
        $q = $request->q;
        $kendaraans = Kendaraan::with('kategori')->orWhere('name', 'like', '%'.$q.'%')->withAvg('ratingKendaraan', 'jumlah_bintang')->paginate(6);
        $kategorisQuery = Array();
        if(isset($request->kategori)){
            $kategorisQuery = $request->kategori;
            $row= 0;
            foreach($kategorisQuery as $kategori){
                $row += 1;
            }
            dd($row);
            // dd($kategorisQuery);
            $kendaraans = Kendaraan::with('kategori')->whereHas('kategori', function($q) use($kategorisQuery) {
                // Query the name field in status table
                $q->whereIn('name',$kategorisQuery); // '=' is optional
         })->withAvg('ratingKendaraan', 'jumlah_bintang')->orWhere('name', 'like', '%'.$q.'%')->paginate(6);
        }

        $kendaraans->setPath($currentURL);
        // dd($kendaraans);
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
