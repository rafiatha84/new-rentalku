<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiDompet;
use App\Models\Dompet;
use App\Models\Rekening;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Auth;
use Validator;

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
        $users = User::where('role','!=','admin')->get();
        $rekenings = Rekening::get();
        return view('admin.topup',[
            'topups' => $topups,
            'users' => $users,
            'rekenings' => $rekenings
        ]);
    }

    public function topup_create(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'user_id' => 'required|integer',
            'jumlah' => 'required',
            'rekening_id' => 'required'
        ]);
        if($validator->fails())
        {
            return redirect()->route('admin.topup');
            // dd('validator');
        }
        DB::beginTransaction();
        try{
            //get dompet id 
            $dompet = Dompet::where('user_id',$request->user_id)->first();
            //membuat kode unik
            $kode_unik = $this->get_rand();
            $rekening = Rekening::where('id',$request->rekening_id)->first();
            //create dompet transaksi
            $transaksiDompet = TransaksiDompet::create([
                'user_id' => $request->user_id,
                'dompet_id' => $dompet->id,
                'name' => "Top Up",
                'jumlah' => $request->jumlah+$kode_unik,
                'kode_unik' => $kode_unik,
                'bank' => $rekening->singkatan,
                'no_rek' => $rekening->no_rek,
                'status' => 'Pending'
             ]);
             DB::commit();
             return redirect()->route('admin.topup');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('admin.topup');
            // dd($e);
        }
    }

    /**
     * Get Random 3 kode unik pembayaran.
     *
     * @return int $kode_unik
     */
    public function get_rand(){
        $kode_unik = mt_rand(102, 476);
        $cek = TransaksiDompet::where('kode_unik',$kode_unik)->where('status','Pending')->get();
        if(count($cek)>0){
            get_rand();
        }else{
            return $kode_unik;
        }
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
        $penarikans = TransaksiDompet::where('name','Penarikan')->orderBy('created_at','DESC')->get();
        $users = User::where('role','!=','admin')->get();
        return view('admin.penarikan',[
            'penarikans' => $penarikans,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function penarikan_create(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'user_id' => 'required|integer',
            'jumlah' => 'required',
            'bank' => 'required',
            'no_rek' => 'required',
            'atas_nama' => 'required'
        ]);

        if($validator->fails())
        {
            return redirect()->route('admin.penarikan');
        }
        DB::beginTransaction();
        try{
            //get dompet id 
            $dompet = Dompet::where('user_id',$request->user_id)->first();
            //get saldo saat ini
            $saldo = TransaksiDompet::where('dompet_id', $dompet->id)->where('status','Dikonfirmasi')->groupBy('user_id')->sum('jumlah');


            //cek apakah jumlah penrikan cukup
            if($saldo >= $request->jumlah){
                //saldo cukup
                //create dompet transaksi
                $transaksiDompet = TransaksiDompet::create([
                    'user_id' => $request->user_id,
                    'dompet_id' => $dompet->id,
                    'name' => "Penarikan",
                    'jumlah' => (-1)*$request->jumlah,
                    'kode_unik' => 0,
                    'bank' => $request->bank,
                    'no_rek' => $request->no_rek,
                    'status' => 'Dikonfirmasi',
                    'atas_nama' => $request->atas_nama,
                    'keterangan' => "Pengajuan"
                ]);
                $saldo = TransaksiDompet::where('dompet_id', $dompet->id)->where('status','Dikonfirmasi')->groupBy('user_id')->sum('jumlah');
                $updatesaldo = Dompet::where('id',$transaksiDompet->dompet_id)->update([
                    'saldo' => $saldo
                ]);
                DB::commit();
                return redirect()->route('admin.penarikan');

            }else{
                DB::rollback();
                return redirect()->route('admin.penarikan');
            }
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('admin.penarikan'); 
        }
    }

    public function konfirmasi_penarikan($transaksi_dompet_id)
    {
        DB::beginTransaction();
        try{
            //get transaksidompet
            $transaksiDompet = TransaksiDompet::where('id',$transaksi_dompet_id)->firstOrFail();
            //update status menjadi Dikonfirmasi
            $updatetransaksi= TransaksiDompet::where('id',$transaksi_dompet_id)->update([
                'status' => 'Dikonfirmasi',
                'keterangan' => 'Dikonfirmasi'
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
            return redirect()->route('admin.penarikan');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('admin.penarikan'); 
        }
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
