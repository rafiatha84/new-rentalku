<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PemilikUnitkuController extends Controller
{
    public function index(){
        return view('pemilik.unitku');
    }

    public function detail($kedaraan_id)
    {
        return view('pemilik.unitku-detail');
    }

    public function edit($kedaraan_id)
    {
        return view('pemilik.unitku-edit');
    }

    public function create()
    {
        return view('pemilik.unitku-create');
    }

    public function ulasan($kendaraan_id)
    {
        return view('pemilik.unitku-ulasan');
    }
}

