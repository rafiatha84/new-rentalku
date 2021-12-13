<?php

namespace App\Http\Controllers\API;

use App\Models\Pengemudi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Dompet;
use Validator;
use Hash;
use Illuminate\Support\Facades\DB;

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
            return response()->json($response, 200);
        }

        else {
            $response = [
                "status" => "gagal",
                "message" => "Pengemudi hilang",
                "error" => null,
                "content" => $pengemudi
            ];
            return response()->json($response, 200);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'owner_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'foto_ktp' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
            'foto_sim' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($validator->fails())
        {
            $response = [
                "status" => "error",
                "message" => 'Validator Error',
                "errors" => $validator->errors(),
                "content" => null,
            ];
            return response()->json($response,404);    
        }
        try{
            $uploadFolder = "image/foto_ktp/";
            $image = $request->file('foto_ktp');
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path($uploadFolder), $imageName);
            $foto_ktp = $uploadFolder.$imageName;

            $uploadFolder = "image/foto_sim/";
            $image = $request->file('foto_sim');
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path($uploadFolder), $imageName);
            $foto_sim = $uploadFolder.$imageName;
            //create user
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = "Pengemudi";
            $user->foto_ktp = $foto_ktp;
            $user->foto_sim = $foto_sim;
            $user->password = Hash::make($request->password);
            $user->save();
            // create dompet
            $dompet = new Dompet();
            $dompet->user_id = $user->id;
            $dompet->saldo = 0;
            $dompet->save();

            $pengemudi = Pengemudi::create([
                'user_id' => $user->id,
                'owner_id' => $request->owner_id,
                'harga' => 0
             ]);
            //commit
            DB::commit();
            $token = $user->createToken('auth_token')->plainTextToken;
            $response = [
                'status' => 'success',
                'msg' => 'Pengemudi Register successfully',
                'errors' => null,
                'content' => $pengemudi,
            ];
            return response()->json($response, 201);
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
            return response()->json($response, 200);
        }

        else {
            $response = [
                "status" => "gagal",
                "message" => "Pengemudi hilang",
                "error" => null,
                "content" => $pengemudi
            ];
            return response()->json($response, 200);
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
            return response()->json($response, 200);
        }

        else {
            $response = [
                "status" => "gagal",
                "message" => "Pengemudi hilang",
                "error" => null,
                "content" => $pengemudi
            ];
            return response()->json($response, 200);
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
        $pengemudi = Pengemudi::findOrFail($pengemudi_id);
        $user = User::findOrFail($pengemudi->user_id);
        $data_update = $request->only(['name','email']);
        if($request->password != null)
        {
            $data_update['password'] = Hash::make($request->password);
        }
        if($request->has('foto_ktp')){
            $uploadFolder = "image/foto_ktp/";
            $image = $request->file('foto_ktp');
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path($uploadFolder), $imageName);
            $image_link = $uploadFolder.$imageName;
            $data_update['foto_ktp'] = $image_link;
        }
        if($request->has('foto_sim')){
            $uploadFolder = "image/foto_sim/";
            $image = $request->file('foto_sim');
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path($uploadFolder), $imageName);
            $image_link = $uploadFolder.$imageName;
            $data_update['foto_sim'] = $image_link;
        }
        // return response()->json($data_update, 201);
        $update = User::where('id',$user->id)->update($data_update);
        if($update){
            $response = [
                "status" => "success",
                "message" => "berhasil update pengemudi",
                "error" => null,
                "content" => $update
            ];
            return response()->json($response, 201);
        }else{
            $response = [
                "status" => "error",
                "message" => "gagal update pengemudi",
                "error" => null,
                "content" => null
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
    public function update_old(Request $request, $pengemudi_id)
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
    public function destroy($id)
    {
        $pengemudi = Pengemudi::where('id',$id)->first();
        
        if ($pengemudi) {
            $user = User::where('id',$pengemudi->user_id)->first();
            $user->delete();
            $response = [
                "status" => "deleted",
                "message" => "Pengemudi berhasil dihapus",
                "error" => null,
                "content" => "$pengemudi"
            ];
            return response()->json($response, 201);
        } else {
            $response = [
                "status" => "deleted",
                "message" => 'Pengemudi gagal dihapus',
                "errors" => null,
                "content" => $pengemudi,
            ];
            return response()->json($response, 201);
        }
        
    }
}
