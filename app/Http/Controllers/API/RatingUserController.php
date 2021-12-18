<?php

namespace App\Http\Controllers\API;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RatingUser;
use App\Models\User;
use App\Models\Kendaraan;

class RatingUserController extends Controller
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


        $rating = RatingUser::create([
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
        $kendaraan = Kendaraan::findOrFail($kendaraan_id);
        $user_id = $kendaraan->user_id;
        $rating = User::with('ratingUser.user','avgRating')->where('id',$user_id)->first();
        // $rating = RatingUser::where('kendaraan_id', $kendaraan_id)->with('user','kendaraan')->get();
        
        if ($rating) {
            $response = [
                "status" => "success",
                "message" => 'Data Rating Kendaraan Ditemukan',
                "errors" => null,
                "content" => $rating,
            ];
            return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
        }else{
            $response = [
                "status" => "error",
                "message" => 'Data Rating Kendaraan Tidak Ditemukan',
                "errors" => null,
                "content" => $rating,
            ];
            return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
            
            
        }
        return response($rating, 200);
    }

    public function show_byuser($user_id)
    {
        $rating = User::with('ratingUser.user','avgRating')->where('id',$user_id)->first();
        // $rating = RatingUser::where('kendaraan_id', $kendaraan_id)->with('user','kendaraan')->get();
        
        if ($rating) {
            $response = [
                "status" => "success",
                "message" => 'Data Rating Kendaraan Ditemukan',
                "errors" => null,
                "content" => $rating,
            ];
            return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
        }else{
            $response = [
                "status" => "error",
                "message" => 'Data Rating Kendaraan Tidak Ditemukan',
                "errors" => null,
                "content" => $rating,
            ];
            return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
            
            
        }
        return response($rating, 200);
    }

    public function showId($rating_id)
    {
        $rating = RatingUser::with('user','kendaraan')->get();

        if(count([$rating]) > 0){
            $response = [
                "status" => "success",
                "message" => 'Data rating by id Ditemukan',
                "errors" => null,
                "content" => $rating,
            ];
            return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
        }else{
            $response = [
                "status" => "error",
                "message" => 'Data rating by id Tidak Ditemukan',
                "errors" => null,
                "content" => $rating,
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


        $rating = RatingUser::where('id',$id)->update([
            'user_id' => $request->user_id,
            'kendaraan_id' => $request->kendaraan_id,
            'jumlah_bintang' => $request->jumlah_bintang,
            'review' => $request->review
            
         ]);
         if ($rating) {
             $rating_data = RatingUser::where('id', $id)->get();
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
        $rating = RatingUser::first($id);
        
        $response = [
            "status" => "deleted",
            "message" => 'rating berhasil dihapus',
            "errors" => null,
            "content" => $rating
        ];

        return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);

        if ($response) {
            $rating->delete();
        } else {
            $response = [
                "status" => "failed",
                "message" => 'rating gagal dihapus',
                "errors" => null,
                "content" => $rating
            ];
    
            return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
        }
        
    }
}
