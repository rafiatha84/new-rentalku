<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Kendaraan;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class UserKendaraanController extends Controller
{
    public function index()
    {

    }

    public function search(Request $request)
    {
        $kategoris = Kategori::get();
        $currentURL = $request->fullUrl();
        $queryArray = array();
        $kategorisQuery = array();
        $kota = "";
        $q = "";
        if (isset($request->kategori)) {
            $kategorisQuery = $request->kategori;
            $kategori = Kategori::select('id')->whereIn('name', $kategorisQuery)->get();
            $kategoriArray = array();
            foreach ($kategori as $k) {array_push($kategoriArray, $k->id);}
            if (count($kategoriArray) > 0) {
                $query = "kategori_id IN" . "(" . implode(",", $kategoriArray) . ")";
                array_push($queryArray, $query);
            } else {
                $query = "kategori_id IN (0)";
                array_push($queryArray, $query);
            }
        }
        if (isset($request->kota)) {
            $kota = $request->kota;
            $kotasId = Lokasi::select('id')->where('name', $kota)->get();
            $kotasIdArray = Array();
            foreach ($kotasId as $u) {array_push($kotasIdArray, $u->id);}
            
            $user = User::whereIn('lokasi_id', $kotasIdArray)->get();
            $userIdArray = array();
            foreach ($user as $u) {array_push($userIdArray, $u->id);}
            if (count($userIdArray) > 0) {
                $query = "user_id IN" . "(" . implode(",", $userIdArray) . ")";
                array_push($queryArray, $query);
            } else {
                $query = "user_id IN (0)";
                array_push($queryArray, $query);
            }
        }
        $queryAkhir = "1 = 1";
        if (count($queryArray) > 0) {
            if (count($queryArray) > 1) {
                $queryAkhir = $queryArray[0] . " AND " . $queryArray[1];
            } else {
                $queryAkhir = $queryArray[0];
            }
        }
        $transaksi = Transaksi::where('status', 'Proses')->get();
        $unitIdArray = array(0);
        foreach ($transaksi as $t) {array_push($unitIdArray, $t->kendaraan_id);};
        if (isset($request->q) && $request->q != "") {
            $q = $request->q;
            $kendaraans = Kendaraan::with('kategori', 'transaksi')->withAvg('ratingKendaraan', 'jumlah_bintang')->whereNotIn('id', $unitIdArray)->whereRaw($queryAkhir)->where('name', 'like', '%' . $request->q . '%')->paginate(6);
        } else {
            $kendaraans = Kendaraan::with('kategori', 'transaksi')->withAvg('ratingKendaraan', 'jumlah_bintang')->whereNotIn('id', $unitIdArray)->whereRaw($queryAkhir)->paginate(6);
        }

        $kendaraans->setPath($currentURL);
        // dd($kendaraans);
        return view('user.search', [
            "kendaraans" => $kendaraans,
            "kategorisQuery" => $kategorisQuery,
            "kota" => $kota,
            "query" => $q,
            "kategoris" => $kategoris,
        ]);
    }

    public function detail($kendaraan_id)
    {
        $kendaraan = Kendaraan::withAvg('ratingKendaraan', 'jumlah_bintang')->findOrfail($kendaraan_id);
        // dd($kendaraan);
        return view('user.detail-produk', ["kendaraan" => $kendaraan]);
    }

    public function ulasan($kendaraan_id)
    {
        $kendaraan = Kendaraan::with('ratingKendaraan.user')->withAvg('ratingKendaraan', 'jumlah_bintang')->findOrfail($kendaraan_id);
        // dd($kendaraan->ratingKendaraan[0]->user->name);
        return view('user.detail-produk-ulasan', ["kendaraan" => $kendaraan]);
    }

    public function ulasan_pemilik($pemilik_id)
    {
        $pemilik = User::with('ratingUser.user')->withAvg('ratingUser', 'jumlah_bintang')->findOrfail($pemilik_id);
        // dd($pemilik);
        return view('user.detail-produk-ulasan-pemilik', ["pemilik" => $pemilik]);
    }
}
