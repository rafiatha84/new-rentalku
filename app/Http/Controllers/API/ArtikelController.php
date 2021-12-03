<?php

namespace App\Http\Controllers\API;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Validator;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artikel = Artikel::with('user')->get();
        

        if(count($artikel) > 0){
            $response = [
                "status" => "success",
                "message" => 'Data Artikel Ditemukan',
                "errors" => null,
                "content" => $artikel,
            ];
            return response($response, 200);
        }else{
            $response = [
                "status" => "error",
                "message" => 'Data Artikel Tidak Ditemukan',
                "errors" => null,
                "content" => $artikel,
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
            'judul' => 'required',
            'content' => 'required',
            'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
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

        $uploadFolder = "image/artikel/";
        $image = $request->file('image');
        $imageName = time().'-'.$image->getClientOriginalName();
        $image->move(public_path($uploadFolder), $imageName);
        $image_link = $uploadFolder.$imageName;
        
        $artikel = Artikel::create([
            'user_id' => $request->user_id,
            'judul' => $request->judul,
            'content' => $request->content,
            'image' => $image_link
         ]);

        if ($artikel) {
            $artikel->image_link = URL::to($artikel->image_link);
            $response = [
                "status" => "success",
                "message" => 'Berhasil Menambah artikel',
                "errors" => null,
                "content" => $artikel,
            ];
            return response()->json($response,201);
        } else {
            
            $response = [
                "status" => "error",
                "message" => 'Gagal Menambah artikel',
                "errors" => null,
                "content" => $artikel,
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
    public function edit($id)
    {
        
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
            'judul' => 'required',
            'content' => 'required',
            'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
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

        $uploadFolder = "image/artikel/";
        $image = $request->file('image');
        $imageName = time().'-'.$image->getClientOriginalName();
        $image->move(public_path($uploadFolder), $imageName);
        $image_link = $uploadFolder.$imageName;

        $artikel = Artikel::where('id', $id)->update([
            'user_id' => $request->user_id,
            'judul' => $request->judul,
            'content' => $request->content,
            'image' => $image_link
         ]);

         if ($artikel){
            $artikel_data = Artikel::where('id', $id)->get();
             $response = [
                 "status" => "success",
                 "message" => 'Berhasil update artikel',
                 "errors" => null,
                 "content" => $artikel_data,
             ];

             
             return response()->json([
                 "response" => $response,
                "image" => URL::to($image_link)],201);
         }

         else {
        $response = [
            "status" => "gagal",
            "message" => 'gagal update artikel',
            "errors" => null,
            "content" => $artikel,
        ];

        return response()->json($response, 201);
        
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artikel $artikel, $id)
    {
        $transaksi = Artikel::first($id);
        
        $response = [
            "status" => "deleted",
            "message" => 'Artikel berhasil dihapus',
            "errors" => null,
            "content" => $artikel,
        ];
        return response()->json($response, 200);
        
        if($response){
            $transaksi->delete();
        }else{
            $response = [
                "status" => "failed",
                "message" => 'Artikel gagal dihapus',
                "errors" => null,
                "content" => $artikel,
            ];
            return response()->json($response, 200);
        }
      
    }
}
