<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Validator;
use App\Models\Kendaraan;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kendaraans = Kendaraan::with('kategori','avgRating')->withAvg('ratingKendaraan', 'jumlah_bintang')->get();
        // $kendaraanArray = $kendaraans->toArray();
        // dd($kendaraanArray);
        // $kendaraans = $kendaraans->map(function($kendaraan) {
        //     $kendaraan->kategori_name = $kendaraan->kategori->name;
        //     return $kendaraan;
        // });

        if(count([$kendaraans]) > 0){
            $response = [
                "status" => "success",
                "message" => 'Data kendaraan Ditemukan',
                "errors" => null,
                "content" => $kendaraans,
            ];
            return response()->json($response, 200);
            
        }
        else{
            $response = [
                "status" => "gagal",
                "message" => 'Data kendaraan tidak Ditemukan',
                "errors" => null,
                "content" => $kendaraans,
            ];
            return response()->json($response, 404,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
        }
    }

    public function search(Request $request){
        $kategoris = Kategori::get();
        $currentURL = $request->fullUrl();
        $queryArray = Array();
        $kategorisQuery = Array();
        $kota = "";
        $q = "";
        if(isset($request->kategori)){
            $kategorisQuery = $request->kategori;
            $kategori = Kategori::select('id')->whereIn('name',$kategorisQuery)->get();
            $kategoriArray = Array();
            foreach($kategori as $k){array_push($kategoriArray,$k->id);}
            if(count($kategoriArray) > 0){
                $query = "kategori_id IN"."(".implode(",",$kategoriArray).")";
                array_push($queryArray,$query);
            }else{
                $query = "kategori_id IN (0)";
                array_push($queryArray,$query);
            }
        }
        if(isset($request->kota) && $request->kota != ""){
            $kota = $request->kota;
            $user = User::where('kota',$request->kota)->get();
            $userIdArray = Array();
            foreach($user as $u){array_push($userIdArray,$u->id);}
            if(count($userIdArray) > 0){
                $query = "user_id IN"."(".implode(",",$userIdArray).")";
                array_push($queryArray,$query);
            }else{
                $query = "user_id IN (0)";
                array_push($queryArray,$query);
            }
        }
        $queryAkhir = "1 = 1";
        if(count($queryArray) > 0){
            if(count($queryArray) > 1){
                $queryAkhir = $queryArray[0]." AND ".$queryArray[1];
            }else{
                $queryAkhir = $queryArray[0];
            }
        }
        $transaksi = Transaksi::where('status','Proses')->get();
        $unitIdArray = Array(0);
        foreach($transaksi as $t){array_push($unitIdArray,$t->kendaraan_id);};
        if(isset($request->q) && $request->q != ""){
            $q = $request->q;
            $kendaraans = Kendaraan::with('kategori','avgRating')->withAvg('ratingKendaraan', 'jumlah_bintang')->whereNotIn('id',$unitIdArray)->whereRaw($queryAkhir)->where('name', 'like', '%'.$request->q.'%')->get();
        }else{
            $kendaraans = Kendaraan::with('kategori','avgRating')->withAvg('ratingKendaraan', 'jumlah_bintang')->whereNotIn('id',$unitIdArray)->whereRaw($queryAkhir)->get();
        }
        if(count($kendaraans) > 0){
            $response = [
                "status" => "success",
                "message" => 'Data kendaraan Ditemukan',
                "errors" => null,
                "content" => $kendaraans,
            ];
            return response()->json($response, 200); 
        }
        else{
            $response = [
                "status" => "gagal",
                "message" => 'Data kendaraan tidak Ditemukan',
                "errors" => null,
                "content" => $kendaraans,
            ];
            return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
        }
    }

    public function most()
    {
        $kendaraans = Kendaraan::with('kategori','avgRating')->withAvg('ratingKendaraan', 'jumlah_bintang')->skip(0)->take(2)->get();
        if(count($kendaraans) > 0){
            $response = [
                "status" => "success",
                "message" => 'Data kendaraan Ditemukan',
                "errors" => null,
                "content" => $kendaraans,
            ];
            return response()->json($response, 200);
            
        }
        else{
            $response = [
                "status" => "gagal",
                "message" => 'Data kendaraan tidak Ditemukan',
                "errors" => null,
                "content" => $kendaraans,
            ];
            return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
        }
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
            'kategori_id' => 'required|integer',
            'name' => 'required',
            'kota' => 'required',
            'seat' => 'required',
            'nopol' => 'required',
            'harga' => 'required|integer',
            'tahun' => 'required|integer',
            'transmisi' => 'required',
            'mesin' => 'required',
            'warna' => 'required',
            'image_link' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
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

        $uploadFolder = "image/car/";
        $image = $request->file('image_link');
        $imageName = time().'-'.$image->getClientOriginalName();
        $image->move(public_path($uploadFolder), $imageName);
        $image_link = $uploadFolder.$imageName;
        

        $kendaraan = Kendaraan::create([
            'user_id' => $request->user_id,
            'kategori_id' => $request->kategori_id,
            'name' =>  $request->name,
            'kota' =>  $request->kota,
            'seat' =>  $request->seat,
            'nopol' => $request->nopol,
            'harga' =>  $request->harga,
            'tahun' =>  $request->tahun,
            'transmisi' =>  $request->transmisi,
            'mesin' =>  $request->mesin,
            'warna' =>  $request->warna,
            'supir' =>  1,
            'image_link' => $image_link,
         ]);
         if($kendaraan){ //cek apakah sukses create 
            //jika sukses
            $kendaraan = Kendaraan::with('kategori','avgRating')->withAvg('ratingKendaraan', 'jumlah_bintang')->where('id',$kendaraan->id)->firstOrFail();
            $response = [
                "status" => "success",
                "message" => 'Berhasil Menambah kendaraan',
                "errors" => null,
                "content" => $kendaraan,
            ];
            return response()->json($response,201);

         }else{
             //jika gagal
             $response = [
                "status" => "error",
                "message" => 'Gagal Menambah kendaraan',
                "errors" => null,
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
        
    }

    public function showId($kendaraan_id)
    {
        $kendaraan = Kendaraan::where('id', $kendaraan_id)->with('user','kategori')->first();
        if($kendaraan){
            $response = [
                "status" => "success",
                "message" => 'Data Transaksi Ditemukan',
                "errors" => null,
                "content" => $kendaraan,
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
                "content" => null,
            ];
            return response()->json($response, 404);

        }
    }

    public function showByOwner($user_id)
    {
        $kendaraans = Kendaraan::with('kategori','avgRating')->withAvg('ratingKendaraan', 'jumlah_bintang')->where('user_id',$user_id)->get();

        if(count($kendaraans) > 0){
            $response = [
                "status" => "success",
                "message" => 'Data kendaraan Ditemukan',
                "errors" => null,
                "content" => $kendaraans,
            ];
            return response()->json($response, 200);
            
        }
        else{
            $response = [
                "status" => "gagal",
                "message" => 'Data kendaraan 
                tidak Ditemukan',
                "errors" => null,
                "content" => $kendaraans,
            ];
            return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'name' => 'required',
            'kategori_id' => 'required|integer',
            'nopol' => 'required',
            'seat' => 'required',
            'harga' => 'required|integer',
            'tahun' => 'required|integer'
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

        $data_upload = $request->all();
        // dd($request->has('image_link'));
        if($request->has('image_link'))
        {
            $uploadFolder = "image/car/";
            $image = $request->file('image_link');
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path($uploadFolder), $imageName);
            $image_link = $uploadFolder.$imageName;
            $data_upload['image_link'] = $image_link;
        }

        $kendaraan = Kendaraan::where('id',$id)->update($data_upload);
        if ($kendaraan) {
            $kendaraan_data = Kendaraan::with('kategori','avgRating')->withAvg('ratingKendaraan', 'jumlah_bintang')->where('id',$id)->firstOrFail();
            $response = [
                "status" => "success",
                "message" => 'Berhasil update kendaraan',
                "errors" => null,
                "content" => $kendaraan_data,
            ];

            return response()->json($response,201);
        } else {
            $response = [
                "status" => "gagal",
                "message" => 'gagal update kendaraan',
                "errors" => null,
                "content" => null,
            ];
    
            return response()->json($response, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kendaraan = Kendaraan::first($id);
        
        $response = [
            "status" => "deleted",
            "message" => 'Kendaraan berhasil dihapus',
            "errors" => null,
            "content" => $kendaraan
        ];  

        if($kendaraan){
            $kendaraan->delete();
            return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
        }else{
            $response = [
                "status" => "deleted",
                "message" => 'Kendaraan gagal dihapus',
                "errors" => null,
                "content" => $kendaraan
            ];  
    
            return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
        }
        

    }
}
