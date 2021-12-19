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
        $kendaraans = Kendaraan::with('kategori')->withAvg('ratingKendaraan', 'jumlah_bintang')->whereRaw('user_id = 1')->paginate(6);
        dd($kendaraans);
        $q = $request->q;
        $kategorisQuery = Array();
        if($q != null && $q != ""){
            if(isset($request->kategori)){
                if(isset($request->kota)){
                    //query,kategori,kota
                    $kategorisQuery = $request->kategori;
                    $kategori = Kategori::select('id')->whereIn('name',$kategorisQuery)->get();
                    $kategoriArray = Array();
                    foreach($kategori as $k){array_push($kategoriArray,$k->id);}
                    $user = User::where('kota',$request->kota)->get();
                    $userIdArray = Array();
                    foreach($user as $u){array_push($userIdArray,$u->id);}
                    $kendaraans = Kendaraan::with('kategori')->whereIN('kategori_id',$kategoriArray)->whereIN('user_id',$userIdArray)->withAvg('ratingKendaraan', 'jumlah_bintang')->where('name', 'like', '%'.$q.'%')->paginate(6);
                }else{
                    //query,kategori,!kota
                    $kategorisQuery = $request->kategori;
                    $kategori = Kategori::select('id')->whereIn('name',$kategorisQuery)->get();
                    $kategoriArray = Array();
                    foreach($kategori as $k){array_push($kategoriArray,$k->id);}
                    $kendaraans = Kendaraan::with('kategori')->whereIN('kategori_id',$kategoriArray)->withAvg('ratingKendaraan', 'jumlah_bintang')->where('name', 'like', '%'.$q.'%')->paginate(6);
                }
            }else{
                if(isset($request->kota)){
                    //query,!kategori,kota
                }else{
                    //query,!kategori,!kota
                }
            }
        }else{
            if(isset($request->kategori)){
                if(isser($request->kota)){
                    //!query,kategori,kota

                }else{
                    //!query,kategori,!kota

                }
            }else{
                //!query,!kategori,kota
            }
            $kendaraans = Kendaraan::with('kategori')->withAvg('ratingKendaraan', 'jumlah_bintang')->paginate(6);
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
