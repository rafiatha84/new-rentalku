<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PemilikPemesananController extends Controller
{
    public function index(){

    }

    public function create_form($kendaraan_id){
        return view('user.pemesanan-create');
    }

    public function create(){
        return 'ok';
    }

    public function pesananku(){
        return view('pemilik.pesananku');
    }

    public function pesananku_selesai()
    {
        return view('pemilik.pesananku-selesai');
    }

    public function detail($pemesanan_id)
    {
        return view('pemilik.pemesanan-detail');
    }
}
