<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Kendaraan;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        $response = [
            "status" => "success",
            "message" => 'Data Kategori Ditemukan',
            "errors" => null,
            "content" => $kategori,
        ];

        return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
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
            'name' => 'required'
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

        $kategori = Kategori::create([
            'name' =>$request->name
        ]);

        if ($kategori) {
            $response = [
                "status" => "success",
                "message" => 'Berhasil menambahkan kategori',
                "errors" => null,
                "content" => $kategori,
            ];
            return response()->json($response,200);
        }

        else {
            $response = [
                "status" => "error",
                "message" => 'Gagal Menambah kategori',
                "errors" => null,
                "content" => $kategori,
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
    public function showId($id)
    {
        $kategori = Kategori::findOrFail($id);
        $response = [
            "status" => "success",
            "message" => 'Data Kategori Ditemukan',
            "errors" => null,
            "content" => $kategori,
        ];

        return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);

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
            'name' => 'required'
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

        $kategori = Kategori::where('id', $id)->update([
            'name' => $request->name
        ]);

        if ($kategori) {
            $kategori_data = Kategori::where('id', $id)->get();
            $response = [
                "status" => "sucess",
                "message" => 'Berhasil diupdate',
                "errors" => null,
                "content" => $kategori_data,
            ];
            return response()->json($response,201);
        }

        else {
            $response = [
                "status" => "gagal",
                "message" => 'gagal update artikel',
                "errors" => null,
                "content" => $kategori,
            ];
    
            return response()->json($response, 201);
        }

        
    }

    public function destroy($id)
    {
        $kategori = Kategori::first($id);
        
        

        if ($kategori) {

            $response = [
                "status" => "deleted",
                "message" => 'Kategori berhasil dihapus',
                "errors" => null,
                "content" => $kategori
            ];  
    
            return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
            $kategori->delete();
        } else {
            $response = [
                "status" => "deleted",
                "message" => 'Kategori berhasil dihapus',
                "errors" => null,
                "content" => $kategori
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
            $update = User::where('id',$request->user_id)->update(['kota' => $request->kota]);
            if($update){
                $user = User::with('avgRating')->where('id',$request->user_id)->firstOrFail();
                $response = [
                    "status" => "deleted",
                    "message" => 'Kota berhasil di update.',
                    "errors" => null,
                    "content" => $user
                ];  
        
                return response()->json($response, 200,[
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


