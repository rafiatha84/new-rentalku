<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Dompet;
use App\Models\Transaksi;
use App\Models\TransaksiDompet;
use Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $transaksi= Transaksi::with('kendaraan.kategori','kendaraan.user','pengemudiTransaksi')->whereHas('kendaraan',function($query){
            return $query->where('user_id','=',Auth::user()->id);
        })->where('status','Proses')->get();
        // dd($transaksi);
        // dd($transaksi[1]->chat_room());
        return view('pemilik.pesananku',['transaksis'=>$transaksi]);
    }

    public function pesananku_selesai()
    {
        $transaksi= Transaksi::with('kendaraan.kategori','kendaraan.user','pengemudiTransaksi','ratingKendaraan')->whereHas('kendaraan',function($query){
            return $query->where('user_id','=',Auth::user()->id);
        })->where('status','Selesai')->get();
        // dd($transaksi[0]->ratingKendaraan);
        // dd($transaksi[1]->chat_room());
        return view('pemilik.pesananku-selesai',['transaksis'=>$transaksi]);
    }

    public function detail($pemesanan_id)
    {
        $transaksi = Transaksi::with('kendaraan.kategori','pengemudiTransaksi.pengemudi.user')->findOrFail($pemesanan_id);
        // dd($transaksi);
        return view('pemilik.pemesanan-detail',[
            'transaksi' => $transaksi
        ]);
    }

    public function selesai_action($pemesanan_id)
    {
        DB::beginTransaction();
        try{
            $transaksi = Transaksi::findOrFail($pemesanan_id);
            $update = Transaksi::where('id', $pemesanan_id)->update([
                'status' => 'Selesai'
            ]);
            if($update){
                $update_pemasukan = TransaksiDompet::where('id',$transaksi->transaksi_dompet_id)
                                    ->update([
                                        'status' => 'Dikonfirmasi'
                                    ]);
                if($update_pemasukan){
                    DB::commit();
                    return redirect()->route('pemilik.pesananku.selesai')->with([
                        'status' => 'sukses update selesai'
                    ]);
                }else{
                    return redirect()->route('pemilik.pesananku')->with([
                        'status' => 'gagal update selesai'
                    ]);
                }
            }else{
                return redirect()->route('pemilik.pesananku')->with([
                    'status' => 'gagal update selesai'
                ]);
            }
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('pemilik.pesananku')->with([
                'status' => 'gagal update selesai'
            ]);
        }
        
        
    }
}
