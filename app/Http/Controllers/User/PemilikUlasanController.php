<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class PemilikUlasanController extends Controller
{
    public function ulasan_pemilik(){
        $pemilik = User::with('ratingUser.user')->withAvg('ratingUser', 'jumlah_bintang')->findOrfail(Auth::user()->id);
        // dd($pemilik);
        return view('pemilik.penilaian-ulasan',["pemilik" => $pemilik]);
    }
}
