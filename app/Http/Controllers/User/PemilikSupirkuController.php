<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengemudi;
use Auth;

class PemilikSupirkuController extends Controller
{
    public function index(){
        $pengemudis = Pengemudi::where('owner_id',Auth::user()->id)->get();
        return view('pemilik.supirku',[
            'pengemudis' => $pengemudis
        ]);
    }

    public function detail($pengemudi_id)
    {
        $pengemudi = Pengemudi::findOrFail($pengemudi_id);
        return view('pemilik.supirku-detail',[
            'pengemudi' => $pengemudi
        ]);
    }

    public function edit($pengemudi_id)
    {
        $pengemudi = Pengemudi::findOrFail($pengemudi_id);
        return view('pemilik.supirku-edit',[
            'pengemudi' => $pengemudi
        ]);
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
