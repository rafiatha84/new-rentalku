<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Transaksi;
use App\Models\TransaksiDompet;
use App\Models\Dompet;
use App\Models\PengemudiTransaksi;
use App\Models\Pengemudi;
use App\Models\Message;
use App\Models\ChatRoom;
use App\Models\RatingKendaraan;
use App\Models\RatingUser;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::with('user', 'kendaraan.kategori', 'kendaraan.user', 'pengemudiTransaksi.pengemudi.user')->get();

        if (count([$transaksi]) > 0) {
            $response = [
                "status" => "success",
                "message" => 'Data Transaksi Ditemukan',
                "errors" => null,
                "content" => $transaksi,
            ];
            return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
        }
        else {
            $response = [
                "status" => "gagal",
                "message" => 'Data transaksi tidak Ditemukan',
                "errors" => null,
                "content" => $transaksi,
            ];
            return response()->json($response, 404);
        }
;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'kendaraan_id' => 'required|integer',
            'waktu_ambil' => 'required',
            'waktu_kembali' => 'required',
            'name' => 'required',
            'telp' => 'required',
            'nik' => 'required',
            'foto_ktp' =>  'required|image:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($validator->fails())
        {
            $response = [
                "status" => "error",
                "message" => 'Kolom belum diisi',
                "errors" => $validator->errors(),
                "content" => null,
            ];
            return response()->json($response,404);
        }
        DB::beginTransaction();
        try{
            //code
            $date1 = Carbon::parse($request->waktu_ambil);
            $date2 = Carbon::parse($request->waktu_kembali);
            $durasi = $date1->diffInDays($date2);
            $durasi += 1;
            $kendaraan = Kendaraan::findOrFail($request->kendaraan_id);
            $saldo = TransaksiDompet::where('user_id', $request->user_id)->where('status','Dikonfirmasi')->groupBy('user_id')->sum('jumlah');
            $jumlah = $kendaraan['harga'] * $durasi;
            if ($saldo >= $jumlah) {
                //jika saldo cukup
                $transaksi_dompet = TransaksiDompet::create([
                    "user_id" => $request->user_id,
                    "dompet_id" => $request->user_id,
                    "name" => 'Pembayaran',
                    "jumlah" => (-1 * $jumlah),
                    "kode_unik" => 0,
                    "bank" => null,
                    "no_rek" => null,
                    "status" => 'Dikonfirmasi',
                    "keterangan" => $kendaraan->name
                ]);
                $transaksi_dompet_pemasukan = TransaksiDompet::create([
                    "user_id" => $kendaraan->user_id,
                    "dompet_id" => $kendaraan->user_id,
                    "name" => 'Pemasukan',
                    "jumlah" => (1 * $jumlah),
                    "kode_unik" => 0,
                    "bank" => null,
                    "no_rek" => null,
                    "status" => 'Pending',
                    "keterangan" => $kendaraan->name
                ]);
                $lat = 0;
                $long = 0;
                $alamat = "";
                if(isset($request->lat,$request->long)){
                    $lat = $request->lat;
                    $long = $request->long;
                }
                if(isset($request->alamat)){
                    $alamat = $request->alamat;
                }
                $uploadFolder = "image/ktp/";
                $image = $request->file('foto_ktp');
                $imageName = time().'-'.$image->getClientOriginalName();
                $image->move(public_path($uploadFolder), $imageName);
                $image_link = $uploadFolder.$imageName;

                
                $transaksi = Transaksi::create([
                    'user_id' => $request->user_id,
                    'transaksi_dompet_id' => $transaksi_dompet_pemasukan->id,
                    'kendaraan_id' => $request->kendaraan_id,
                    'waktu_ambil' => $request->waktu_ambil,
                    'waktu_kembali' => $request->waktu_kembali,
                    'durasi' => $durasi,
                    'name' => $request->name,
                    'telp' => $request->telp,
                    'nik' => $request->nik,
                    'foto_ktp' => $image_link,
                    'total_harga' => $jumlah,
                    'denda' => 0,
                    'status' => 'Proses',
                    'lat' => $lat,
                    'long' => $long,
                    'alamat' => $alamat
                ]);
                $updatesaldo = Dompet::where('user_id',$request->user_id)->update([
                    'saldo' => $saldo-$jumlah
                ]);
                //melakukan pembuatan chat room dgn pemilik bagi yang telah memesan
                $chat_room = ChatRoom::where('user_id',$kendaraan->user_id)->where('user_to_id',$request->user_id)->first();
                if($chat_room){
                    $message = [
                        'user_id' => $kendaraan->user_id, 
                        "chat_room_id" => $chat_room->id, 
                        "message" => "Terima kasih telah menyewa mobil dengan kami",
                    ];
                    $message = Message::create($message);
                }else{
                    $chat_room_data =[
                        'user_id' => $kendaraan->user_id,
                        "user_to_id" => $request->user_id
                    ];
                    $new_chat_room = ChatRoom::create($chat_room_data);
                    $message = [
                        'user_id' => $kendaraan->user_id, 
                        "chat_room_id" => $new_chat_room->id, 
                        "message" => "Terima kasih telah menyewa mobil dengan kami",
                    ];
                    $message = Message::create($message);
                }
                $saldoSekarang = TransaksiDompet::where('user_id', $request->user_id)->where('status','Dikonfirmasi')->groupBy('user_id')->sum('jumlah');
                $transaksi['transaksi_dompet'] = $transaksi_dompet;
                $transaksi['sisa_saldo'] = $saldoSekarang;
                if(isset($request->pengemudi_id)){
                    $pengemudi = Pengemudi::findOrFail($request->pengemudi_id);
                    $pengemudiTransaksi = PengemudiTransaksi::create([
                        'pengemudi_id' => $request->pengemudi_id,
                        'transaksi_id' => $transaksi->id
                    ]);
                    $transaksi['pengemudi'] = $pengemudi;
                    //melakukan pembuatan chat room dgn driver apabila memesan supir bagi yang telah memesan
                    $chat_room = ChatRoom::where('user_id',$pengemudi->user_id)->where('user_to_id',$request->user_id)->first();
                    if($chat_room){
                        $message = [
                            'user_id' => $pengemudi->user_id,
                            "chat_room_id" => $chat_room->id,
                            "message" => "Terima kasih telah memesan driver",
                        ];
                        $message = Message::create($message);
                        
                    }else{
                        $chat_room_data = [
                            'user_id' => $pengemudi->user_id,
                             "user_to_id" => $request->user_id
                        ];
                        $new_chat_room = ChatRoom::create($chat_room_data);
                        $message = [
                            'user_id' => $pengemudi->user_id,
                            "chat_room_id" => $new_chat_room->id,
                            "message" => "Terima kasih telah memesan driver",
                        ];
                        $message = Message::create($message);   
                    }
                }
                $response = [
                    "status" => "success",
                    "message" => 'Berhasil dibuat',
                    "errors" => null,
                    "content" => $transaksi,
                ];
                DB::commit();
                return response()->json($response,201);
            }
            else {
                $response = [
                    "status" => "error",
                    "message" => 'Saldo tidak cukup',
                    "errors" => null,
                    "content" => null,
                ];
                DB::commit();
                return response()->json($response, 404);
            }

        }catch(\Exception $e){
            DB::rollback();
            $response = [
                "status" => "error",
                "message" => 'Error',
                "errors" => $e->getMessage(),
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
    public function show($user_id)
    {
        $transaksi = Transaksi::where('user_id', $user_id)->with('user','kendaraan.kategori','pengemudiTransaksi')->with('kendaraan.ratingKendaraan')->get();
        
        if(count([$transaksi]) > 0){
            $response = [
                "status" => "success",
                "message" => 'Data transaksi Ditemukan',
                "errors" => null,
                "content" => $transaksi,
            ];
            return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
            
        }
        else{
            $response = [
                "status" => "gagal",
                "message" => 'Data transaksi tidak Ditemukan',
                "errors" => null,
                "content" => $transaksi,
            ];
            return response()->json($response, 404);
        }
    }

    public function showId($transaksi_id)
    {
        $transaksi = Transaksi::where('id', $transaksi_id)->with('user','kendaraan.kategori', 'kendaraan.user', 'pengemudiTransaksi.pengemudi.user')->first();

        if($transaksi){
            $data = $transaksi;
            $data['tanggal_transaksi'] = $transaksi->tanggal_transaksi();
            $data['tanggal_berakhir'] = $transaksi->tanggal_berakhir();
            $data['sopir'] = $transaksi->sopir();
            $response = [
                "status" => "success",
                "message" => 'Data Transaksi Ditemukan',
                "errors" => null,
                "content" => $data,
            ];
            return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
        }else{
            $response = [
                "status" => "error",
                "message" => 'Data Transaksi Tidak Ditemukan',
                "errors" => null,
                "content" => $transaksi,
            ];
            return response()->json($response, 404);

        }
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
            'kendaraan_id' => 'required|integer',
            'waktu_ambil' => 'required',
            'durasi' => 'required',
            'denda' => 'required',
            'status' => 'required',
            'lat' => 'required',
            'long' => 'required'
        ]);

        if($validator->fails())
        {
            $response = [
                "status" => "error",
                "message" => 'Validator Error',
                "errors" => $validator->errors(),
                "content" => null,
            ];
            return response()->json($response);
        }

        $transaksi = Transaksi::where('id', $id)->update([
            'user_id' => $request->user_id,
            'kendaraan_id' => $request->kendaraan_id,
            'waktu_ambil' => $request->waktu_ambil,
            'durasi' => $request->durasi,
            'denda' => $request->denda,
            'status' => $request->status,
            'lat' => $request->lat,
            'long' => $request->long
        ]);

        if ($transaksi) {
            $transaksiData = Transaksi::where('id', $id)->get();

            $response = [
                "status" => "success",
                "message" => 'Berhasil update kendaraan',
                "errors" => null,
                "content" => $transaksiData,
            ];

            return response()->json($response);

        } else {
            $response = [
                "status" => "gagal",
                "message" => 'gagal update kendaraan',
                "errors" => null,
                "content" => $transaksi,
            ];
    
            return response()->json($response, 404);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($transaksi_id)
    {
        $transaksi = Transaksi::first($id);

        $response = [
            "status" => "deleted",
            "message" => 'Transaksi berhasil dihapus',
            "errors" => null,
            "content" => $transaksi
        ];

        if($transaksi){
            $transaksi->delete();
            return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
        }else{
            $response = [
                "status" => "deleted",
                "message" => 'Transaksi gagal dihapus',
                "errors" => null,
                "content" => $transaksi
            ];

            return response()->json($response, 404);
        }
        
    }

    public function update_selesai($transaksi_id)
    {
        $transaksi = Transaksi::where('id', $transaksi_id)->update([
            'status' => 'Selesai'
        ]);
        if ($transaksi) {
            $transaksiData = Transaksi::where('id', $transaksi_id)->get();

            $response = [
                "status" => "success",
                "message" => 'Berhasil update kendaraan',
                "errors" => null,
                "content" => $transaksiData,
            ];

            return response()->json($response,201);

        } else {
            $response = [
                "status" => "gagal",
                "message" => 'gagal update kendaraan',
                "errors" => null,
                "content" => $transaksi,
            ];
    
            return response()->json($response, 404);
        }

    }

    public function create_rating(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'user_id' => 'required',
            'transaksi_id' => 'required',
        ]);

        if($validator->fails())
        {
            $response = [
                "status" => "error",
                "message" => 'Kolom belum diisi',
                "errors" => $validator->errors(),
                "content" => null,
            ];
            return response()->json($response,404);
        }
        $transaksi = Transaksi::with('kendaraan.user','pengemudiTransaksi.pengemudi.user')->findOrFail($request->transaksi_id);
        DB::beginTransaction();
        try{
            $content = Array();
            if($request->has('kendaraan_star'))
            {
                $ratingKendaraan = RatingKendaraan::create([
                    'user_id' => $request->user_id,
                    'transaksi_id' => $request->transaksi_id,
                    'kendaraan_id' => $transaksi->kendaraan->id,
                    'jumlah_bintang' => $request->kendaraan_star,
                    'review' => $request->kendaraan_review
                ]);
                $content['ratingKendaraan'] = $ratingKendaraan;
            }
            if($request->has('pemilik_star'))
            {
                $ratingPemilik= RatingUser::create([
                    'user_id' => $request->user_id,
                    'transaksi_id' => $request->transaksi_id,
                    'user_to_id' => $transaksi->kendaraan->user->id,
                    'jumlah_bintang' => $request->pemilik_star,
                    'review' => $request->pemilik_review
                ]);
                $content['ratingPemilik'] = $ratingPemilik;
            }
            if($request->has('pengemudi_star'))
            {
                $ratingPengemudi= RatingUser::create([
                    'user_id' => $request->user_id,
                    'transaksi_id' => $request->transaksi_id,
                    'user_to_id' => $transaksi->pengemudiTransaksi->pengemudi->user->id,
                    'jumlah_bintang' => $request->pengemudi_star,
                    'review' => $request->pengemudi_review
                ]);
                $content['ratingPengemudi'] = $ratingPengemudi;
            }
            
            $response = [
                "status" => "success",
                "message" => 'Berhasil dibuat',
                "errors" => null,
                "content" => $content,
            ];
            DB::commit();
            return response()->json($response,201);
        }catch(\Exception $e){
            DB::rollback();
            $response = [
                "status" => "error",
                "message" => 'Error',
                "errors" => $e->getMessage(),
                "content" => null,
            ];
            return response()->json($response,404);  
        }

    }

    
}
