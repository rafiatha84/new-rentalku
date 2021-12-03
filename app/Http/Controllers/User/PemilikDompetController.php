<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PemilikDompetController extends Controller
{
    public function riwayat(){
        return view('pemilik.dompetku');
    }

    public function penarikan_create(){
        return view('pemilik.dompetku-penarikan');
    }

    public function topup_detail($id)
    {
        return view('pemilik.dompetku-topup-detail');
    }
    public function tutorial()
    {
        return view('pemilik.dompetku-topup-tutorial');
    }
}
