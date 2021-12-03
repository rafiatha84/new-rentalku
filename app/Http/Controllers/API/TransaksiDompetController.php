<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TransaksiDompet;
use App\Models\Dompet;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Rekening;


class TransaksiDompetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'user_id' => 'required|integer',
            'name' => 'required',
            'jumlah' => 'required',
            'kode_unik' => 'required',
            'bank' => 'required',
            'no_rek' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors());
        }


        $transaksiDompet = TransaksiDompet::create([
            'user_id' => $request->user_id,
            'dompet_id' => $request->user_id,
            'name' => $request->name,
            'jumlah' => $request->jumlah,
            'kode_unik' => $request->kode_unik,
            'bank' => $request->bank,
            'no_rek' => $request->no_rek,
            'status' => $request->status
         ]);
         $dompet = TransaksiDompet::where('user_id', $user_id)
            ->selectRaw("SUM(jumlah) as jumlah")->groupBy('user_id')->with('user','dompet')
            ->get();

         return response()->json([
             "transaksi_dompet" => $transaksiDompet
        ],201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function topup(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'user_id' => 'required|integer',
            'jumlah' => 'required',
            'rekening_id' => 'required'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors());
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
                'name' => "Topup Dompetku",
                'jumlah' => $request->jumlah+$kode_unik,
                'kode_unik' => $kode_unik,
                'bank' => $rekening->singkatan,
                'no_rek' => $rekening->no_rek,
                'status' => 'Pending'
             ]);
             DB::commit();
             $response = [
                "status" => "success",
                "message" => 'Silahkan transfer sesuai 3 digit terakhir',
                "errors" => null,
                "content" => $transaksiDompet,
            ];
            return response()->json($response,201); 
        }catch(\Exception $e){
            DB::rollback();
            $response = [
                "status" => "error",
                "message" => 'Error',
                "errors" => $e,
                "content" => null,
            ];
            return response()->json($response,404); 
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
            $response = [
                "status" => "success",
                "message" => 'Topup berhasil Dikonfirmasi',
                "errors" => null,
                "content" => $content,
            ];
            return response()->json($response,201); 
        }catch(\Exception $e){
            DB::rollback();
            $response = [
                "status" => "error",
                "message" => 'Error excepion',
                "errors" => $e,
                "content" => null,
            ];
            return response()->json($response,404); 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function penarikan(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'user_id' => 'required|integer',
            'jumlah' => 'required',
            'bank' => 'required',
            'no_rek' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors());
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
                    'name' => "Penarikan Dompetku",
                    'jumlah' => (-1)*$request->jumlah,
                    'kode_unik' => 0,
                    'bank' => $request->bank,
                    'no_rek' => $request->no_rek,
                    'status' => 'Pending'
                ]);
                DB::commit();
                $response = [
                    "status" => "success",
                    "message" => 'Sukses melakukan penarikan, uang akan ditransfer ke rekening penerima',
                    "errors" => null,
                    "content" => $transaksiDompet,
                ];
                return response()->json($response,201); 

            }else{
                DB::commit();
                //saldo tidak cukup
                $response = [
                    "status" => "error",
                    "message" => 'Jumlah saldo tidak cukup untuk melakukan penarikan',
                    "errors" => null,
                    "content" => null
                ];
                return response()->json($response,404); 
            }
        }catch(\Exception $e){
            DB::rollback();
            $response = [
                "status" => "error",
                "message" => 'Error',
                "errors" => $e,
                "content" => null,
            ];
            return response()->json($response,404); 
        }
    }



    /**
    * Merubah status topup
    * @param int $transaksi_dompet_id
    * @return \Illuminate\Http\Response
    */
    public function konfirmasi_penarikan($transaksi_dompet_id){
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
            $response = [
                "status" => "success",
                "message" => 'Penarikan berhasil, Uang sudah di transfer ke rekening penerima',
                "errors" => null,
                "content" => $content,
            ];
            return response()->json($response,201); 
        }catch(\Exception $e){
            DB::rollback();
            $response = [
                "status" => "error",
                "message" => 'Error excepion',
                "errors" => $e,
                "content" => null,
            ];
            return response()->json($response,404); 
        }
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksiDompet = TransaksiDompet::with('user', 'dompet')->findOrFail($id);
        
        if (is_null($transaksiDompet)) {
            return response()->json('Data not found', 404); 
        }

        return response()->json($transaksiDompet, 200);
    }

    public function saldoDompet($user_id)
    {
        
        $cek = TransaksiDompet::where('user_id', $user_id)->first();
       
        if($cek!= null){
            $dompet = TransaksiDompet::where('user_id', $user_id)->where('status','Dikonfirmasi')
            ->selectRaw("SUM(jumlah) as jumlah")->groupBy('user_id')->with('user','dompet')
            ->first();
            $updatesaldo = Dompet::where('user_id',$user_id)->update([
                'saldo' => $dompet->jumlah
            ]);
            return response()->json($dompet, 200);
        }
        $response =Array(
            Array(
                "jumlah" => 0
            )
        );
        return response()->json($response, 200);
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
        $validator = Validator::make($request->all(), 
        [
            'user_id' => 'required|integer',
            'dompet_id' => 'required|integer',
            'name' => 'required',
            'jumlah' => 'required',
            'kode_unik' => 'required',
            'bank' => 'required',
            'no_rek' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors());
        }

        $transaksiDompet = TransaksiDompet::where('id',$id)->update([
            'user_id' => $request->user_id,
            'dompet_id' => $request->dompet_id,
            'name' => $request->name,
            'jumlah' => $request->jumlah,
            'kode_unik' => $request->kode_unik,
            'bank' => $request->bank,
            'no_rek' => $request->no_rek,
            'status' => $request->status
        ]);

        $transaksiDompetData = TransaksiDompet::where('id', $id)->get();
     
         return response()->json([
             "transaksi_dompet" => $transaksiDompetData
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaksiDompet $transaksiDompet,$id)
    {
        $transaksiDompet = TransaksiDompet::first($id);
        if($transaksiDompet){
            $transaksiDompet->delete();
        }else{
            return response()->json("Data gagal di hapus");
        }
        

        return response()->json("Data berhasil dihapus");
    }
}
