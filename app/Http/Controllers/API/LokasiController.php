<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lokasi;

class LokasiController extends Controller
{
    public function show(){
        $lokasis = Lokasi::get();
        if(count($lokasis) > 0){
            $response = [
                "status" => "success",
                "message" => 'Data lokasi Ditemukan',
                "errors" => null,
                "content" => $lokasis,
            ];
            return response()->json($response, 200); 
        }
        else{
            $response = [
                "status" => "gagal",
                "message" => 'Data lokasi tidak Ditemukan',
                "errors" => null,
                "content" => $lokasis,
            ];
            return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
        }
    }
    public function updateKota(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'user_id' => 'required',
            'kota' => 'required'
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
        try {
            //code...
            $update = User::where('id',$request->user_id)->update(['lokasi_id' => $request->kota]);
            if($update){
                $user = User::with('avgRating','lokasi')->where('id',$request->user_id)->firstOrFail();
                $response = [
                    "status" => "Success",
                    "message" => 'Kota berhasil di update.',
                    "errors" => null,
                    "content" => $user
                ];  
        
                return response()->json($response, 201,[
                    'Content-Type' => 'application/json',
                    'Charset' => 'utf-8'
                ]);
            }else{
                $response = [
                    "status" => "error",
                    "message" => 'Gagal update kota.',
                    "errors" => null,
                    "content" => null,
                ];
                return response()->json($response,404);
            }
        } catch (\Throwable $th) {
            //throw $th;
            $response = [
                "status" => "error",
                "message" => 'Gagal update kota.',
                "errors" => null,
                "content" => null,
            ];
            return response()->json($response,404);
        }
    }
}
