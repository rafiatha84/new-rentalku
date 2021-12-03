<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Validator;
use App\Models\Kendaraan;
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
        $kendaraan = Kendaraan::with('user','kategori',
        'transaksi','ratingKendaraan')->get();

        if(count([$kendaraan]) > 0){
            $response = [
                "status" => "success",
                "message" => 'Data kendaraan Ditemukan',
                "errors" => null,
                "content" => $kendaraan,
            ];
            return response($response, 200);
            
        }
        else{
            $response = [
                "status" => "gagal",
                "message" => 'Data kendaraan tidak Ditemukan',
                "errors" => null,
                "content" => $kendaraan,
            ];
            return response($response, 200);
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
            'supir' => 'required',
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
            return response()->json($response,200);
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
            'supir' =>  $request->supir,
            'image_link' => $image_link,
         ]);
         if($kendaraan){ //cek apakah sukses create 
            //jika sukses
            $kendaraan->image_link = URL::to($kendaraan->image_link);
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
                "content" => $kendaraan,
            ];
            return response()->json($response,200);
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
            'user_id' => 'required|integer',
            'kategori_id' => 'required|integer',
            'nopol' => 'required',
            'seat' => 'required',
            'harga' => 'required|integer',
            'tahun' => 'required|integer',
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
            return response()->json($response,200);
        }

        $uploadFolder = "image/car/";
        $image = $request->file('image_link');
        $imageName = time().'-'.$image->getClientOriginalName();
        $image->move(public_path($uploadFolder), $imageName);
        $image_link = $uploadFolder.$imageName;
        

        $kendaraan = Kendaraan::where('id',$id)->update([
            'user_id' => $request->user_id,
            'kategori_id' => $request->kategori_id,
            'name' => $request->name,
            'nopol' => $request->nopol,
            'seat' => $request->seat,
            'harga' => $request->harga,
            'tahun' => $request->tahun,
            'image_link' => $image_link
         ]);

        if ($kendaraan) {
            $kendaraan_data = Kendaraan::where('id',$id)->get();
            $response = [
                "status" => "success",
                "message" => 'Berhasil update kendaraan',
                "errors" => null,
                "content" => $kendaraan_data,
            ];

            return response()->json([
                "response" => $response,
               "image" => URL::to($image_link)],201);
        } else {
            $response = [
                "status" => "gagal",
                "message" => 'gagal update kendaraan',
                "errors" => null,
                "content" => $kendaraan,
            ];
    
            return response()->json($response, 201);
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
            return response()->json($response, 200);
        }else{
            $response = [
                "status" => "deleted",
                "message" => 'Kendaraan gagal dihapus',
                "errors" => null,
                "content" => $kendaraan
            ];  
    
            return response()->json($response, 200);
        }
        

    }
}
