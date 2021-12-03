<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dompet;
use App\Models\TransaksiDompet;
use App\Models\Rekening;
use Auth;

class UserDompetController extends Controller
{
    public function riwayat(){
        $dompet = Dompet::with('transaksiDompet.transaksi.kendaraan')->where('user_id',Auth::user()->id)->first();
        // dd($dompet->transaksiDompet);
        return view('user.dompetku',[
            'dompet' => $dompet
        ]);
    }

    public function topup_create(){
        $banks = Rekening::where('tipe','bank')->get();
        $wallets = Rekening::where('tipe','e-wallet')->get();
        return view('user.dompetku-topup',[
            'banks' => $banks,
            'wallets' => $wallets
        ]);
    }

    public function topup_detail($id)
    {
        $transaksi_dompet = TransaksiDompet::findOrFail($id);
        // dd($transaksi_dompet->no_rek);
        $rekening = Rekening::where('singkatan',$transaksi_dompet->bank)->where('no_rek',$transaksi_dompet->no_rek)->firstOrFail();
        // $rekening = Rekening::where('no_rek',$transaksi_dompet->no_rek)->first();
        // dd($rekening);
        return view('user.dompetku-topup-detail',[
            'transaksi_dompet' => $transaksi_dompet,
            'rekening' => $rekening
        ]);
    }
    public function tutorial()
    {
        return view('user.dompetku-topup-tutorial');
    }
}
