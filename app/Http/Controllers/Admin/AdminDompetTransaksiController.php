<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\TransaksiDompet;
use App\Models\Dompet;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Rekening;

class AdminDompetTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function topup()
    {
        $topups = TransaksiDompet::where('name','Top Up')->get();
        return view('admin.topup',[
            'topups' => $topups
        ]);
    }

    /**
    * Merubah status topup
    * @param int $transaksi_dompet_id
    * @return \Illuminate\Http\Response
    */
    public function konfirmasi_topup($transaksi_dompet_id){
        // dd('a');
        DB::beginTransaction();
        try{
            //get transaksidompet
            $transaksiDompet = TransaksiDompet::where('id',$transaksi_dompet_id)->firstOrFail();
            //update status menjadi Dikonfirmasi
            $updatetransaksi= TransaksiDompet::where('id',$transaksi_dompet_id)->update([
                'status' => 'Dikonfirmasi'
            ]);
            $transaksiDompet = TransaksiDompet::where('id',$transaksi_dompet_id)->firstOrFail();
            //get saldo saat ini
            $saldo = TransaksiDompet::where('dompet_id', $transaksiDompet->dompet_id)->where('status','Dikonfirmasi')->groupBy('user_id')->sum('jumlah');
            $updatesaldo = Dompet::where('id',$transaksiDompet->dompet_id)->update([
                'saldo' => $saldo
            ]);
            $content = Array(
                "jumlah" => $transaksiDompet->jumlah,
                "status" => $transaksiDompet->status,
                "saldo saat ini" => $saldo
            );
            DB::commit();
            return redirect()->route('admin.topup');
        }catch(\Exception $e){
            return redirect()->route('admin.topup');
        }
    }

    public function penarikan()
    {
        return view('admin.penarikan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
