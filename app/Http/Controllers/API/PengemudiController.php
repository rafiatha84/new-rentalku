<?php

namespace App\Http\Controllers\API;

use App\Models\Pengemudi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class PengemudiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengemudi = Pengemudi::with('user', 'owner', 'pengemudiTransaksi')->get();

        if(count([$pengemudi]) > 0) {
            $response = [
                "status" => "success",
                "message" => "Data pengemudi ditemukan",
                "error" => null,
                "content" => $pengemudi
            ];
            return response($response, 200);
        }

        else {
            $response = [
                "status" => "gagal",
                "message" => "Pengemudi hilang",
                "error" => null,
                "content" => $pengemudi
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
            'owner_id' => 'required|integer',
            'harga' => 'required|integer'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors());
        }


        $pengemudi = Pengemudi::create([
            'user_id' => $request->user_id,
            'owner_id' => $request->owner_id,
            'harga' => $request->harga
            
         ]);

         return response()->json([
             "pengemudi" => $pengemudi
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengemudi = Pengemudi::with('user', 'owner', 'pengemudiTransaksi')->findOrFail($id);
        if(count([$pengemudi]) > 0) {
            $response = [
                "status" => "success",
                "message" => "Data pengemudi ditemukan",
                "error" => null,
                "content" => $pengemudi
            ];
            return response($response, 200);
        }

        else {
            $response = [
                "status" => "gagal",
                "message" => "Pengemudi hilang",
                "error" => null,
                "content" => $pengemudi
            ];
            return response($response, 200);
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_by_owner($owner_id)
    {
        $pengemudi = Pengemudi::with('user', 'owner', 'pengemudiTransaksi')->where('owner_id',$owner_id)->get();
        if(count([$pengemudi]) > 0) {
            $response = [
                "status" => "success",
                "message" => "Data pengemudi ditemukan",
                "error" => null,
                "content" => $pengemudi
            ];
            return response($response, 200);
        }

        else {
            $response = [
                "status" => "gagal",
                "message" => "Pengemudi hilang",
                "error" => null,
                "content" => $pengemudi
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
    public function update(Request $request, $pengemudi_id)
    {
        $validator = Validator::make($request->all(), 
        [
            'user_id' => 'required',
            'owner_id' => 'required',
            'harga' => 'required|int'
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

     
        $pengemudi = Pengemudi::where('id',$pengemudi_id)->update([
            'user_id' => $request->user_id,
            'user_id' => $request->user_id,
            'owner_id' => $request->owner_id,
            'harga' => $request->harga
         ]);

         if ($pengemudi) {
            $pengemudi_data = Pengemudi::where('id',$pengemudi_id)->get();
            $response = [
                "status" => "success",
                "message" => "berhasil update pengemudi",
                "error" => null,
                "content" => $pengemudi_data
            ];

            return response()->json($response, 200);
         } else {
            $response = [
                "status" => "gagal",
                "message" => 'gagal update artikel',
                "errors" => null,
                "content" => $pengemudi,
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
    public function destroy(Pengemudi $pengemudi, $id)
    {
        $pengemudi = Pengemudi::first($id);

        $response = [
            "status" => "deleted",
            "message" => "Pengemudi berhasil dihapus",
            "error" => null,
            "content" => "$pengemudi"
        ];
        return response()->json($response, 200);

        if ($response) {
            $pengemudi->delete();
        } else {
            $response = [
                "status" => "deleted",
                "message" => 'Pengemudi gagal dihapus',
                "errors" => null,
                "content" => $pengemudi,
            ];
            return response()->json($response, 200);
        }
        
    }
}
