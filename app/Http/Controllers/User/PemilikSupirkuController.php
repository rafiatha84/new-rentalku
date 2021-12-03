<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PemilikSupirkuController extends Controller
{
    public function index(){
        return view('pemilik.supirku');
    }

    public function detail($kedaraan_id)
    {
        return view('pemilik.supirku-detail');
    }

    public function edit($kedaraan_id)
    {
        return view('pemilik.supirku-edit');
    }

    public function create()
    {
        return view('pemilik.supirku-create');
    }

    public function ulasan($kendaraan_id)
    {
        return view('pemilik.supirku-ulasan');
    }
}
