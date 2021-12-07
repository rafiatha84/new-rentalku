<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dompet;
use App\Models\TransaksiDompet;
use Auth;

class PemilikDompetController extends Controller
{
    public function riwayat(){
        $dompet = Dompet::with('transaksiDompet.transaksi.kendaraan')->where('user_id',Auth::user()->id)->first();
        return view('pemilik.dompetku',[
            'dompet' => $dompet
        ]);
    }

    public function penarikan_create(){
        $dompet = Dompet::with('transaksiDompet.transaksi.kendaraan')->where('user_id',Auth::user()->id)->first();
        return view('pemilik.dompetku-penarikan',[
            'dompet' => $dompet
        ]);
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
