<?php

namespace App\Http\Controllers\API;

use Validator;
use Illuminate\Http\Request;
use App\Models\RatingKendaraan;
use App\Http\Controllers\Controller;
use App\Models\RatingUser;

class RatingKendaraanController extends Controller
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
            'jumlah_bintang' => 'required|integer',
            'review' => 'required'
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


        $rating = RatingKendaraan::create([
            'user_id' => $request->user_id,
            'kendaraan_id' => $request->kendaraan_id,
            'jumlah_bintang' => $request->jumlah_bintang,
            'review' => $request->review
            
         ]);

         if($rating) {
             $response = [
                 "status" => "success",
                 "message" => "Berhasil menambahkan rating",
                 "errors" => null,
                "content" => $rating
             ];
             
             return response()->json($response, 201);
         }
         
         else {

            $response = [
                "status" => "gagal",
                "message" => "gagal menambahkan rating",
                "errors" => null,
               "content" => $rating
            ];
            
            return response()->json($response, 201);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kendaraan_id)
    {
        $rating = RatingKendaraan::where('kendaraan_id', $kendaraan_id)->with('user','kendaraan')->get();
        
        if (count([$rating]) > 0) {
            $response = [
                "status" => "success",
                "message" => 'Data Rating Kendaraan Ditemukan',
                "errors" => null,
                "content" => $rating,
            ];
            return response($response, 200);
        }else{
            $response = [
                "status" => "error",
                "message" => 'Data Rating Kendaraan Tidak Ditemukan',
                "errors" => null,
                "content" => $rating,
            ];
            return response($response, 200);
        
        return response($rating, 200);
    }
}

    public function showId($rating_id)
    {
        $rating = RatingKendaraan::with('user','kendaraan')->get();

        if(count([$rating]) > 0){
            $response = [
                "status" => "success",
                "message" => 'Data rating by id Ditemukan',
                "errors" => null,
                "content" => $rating,
            ];
            return response($response, 200);
        }else{
            $response = [
                "status" => "error",
                "message" => 'Data rating by id Tidak Ditemukan',
                "errors" => null,
                "content" => $rating,
            ];
            return response($response, 200);
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
            'jumlah_bintang' => 'required|integer',
            'review' => 'required'
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


        $rating = RatingKendaraan::where('id',$id)->update([
            'user_id' => $request->user_id,
            'kendaraan_id' => $request->kendaraan_id,
            'jumlah_bintang' => $request->jumlah_bintang,
            'review' => $request->review
            
         ]);
         if ($rating) {
             $rating_data = RatingKendaraan::where('id', $id)->get();
             $response = [
                "status" => "success",
                "message" => 'Berhasil update dompet',
                "errors" => null,
                "content" => $rating_data,
            ];  

            return response()->json($response, 201);
         }

         else {
            $response = [
                "status" => "success",
                "message" => 'Berhasil update dompet',
                "errors" => null,
                "content" => $rating,
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
    public function destroy($id)
    {
        $rating = RatingKendaraan::first($id);
        
        $response = [
            "status" => "deleted",
            "message" => 'rating berhasil dihapus',
            "errors" => null,
            "content" => $rating
        ];

        return response()->json($response, 200);

        if ($response) {
            $rating->delete();
        } else {
            $response = [
                "status" => "failed",
                "message" => 'rating gagal dihapus',
                "errors" => null,
                "content" => $rating
            ];
    
            return response()->json($response, 200);
        }
        
    }
}
