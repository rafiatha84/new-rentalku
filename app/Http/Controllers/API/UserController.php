<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with('avgRating')->get();
        return response()->json($user, 200);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        if (is_null($user)) {
            return response()->json('Data not found', 404); 
        }
        $response = [
            "status" => "success",
            "message" => 'Tampilkan data user',
            "errors" => null,
            "content" => $user,
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

    public function edit_action(Request $request)
    {
        $request->validate([
            'user_id' => 'required'
        ]);
        // dd($request->has('image'));
        $cek = User::findOrFail($request->user_id);
        $data_update = $request->only(['name','telp','alamat','email','tanggal_lahir']);
        if($request->has('image'))
        {
            $uploadFolder = "image/profil/";
            $image = $request->file('image');
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path($uploadFolder), $imageName);
            $data_update['image_link'] = $uploadFolder.$imageName;
        }

        if($request->new_password != null)
        {
            $password_cek = Hash::check($request->password,$cek->password);
            // dd($password_cek);
            if($password_cek)
            {
                $data_update['password'] = Hash::make($request->new_password);
                // dd($data_update);
                $user = User::where('id',$request->user_id)->update(
                    $data_update
                );
                if($user){
                    $usernew = User::findOrFail($request->user_id);
                    $response = [
                        "status" => "success",
                        "message" => 'Berhasil Edit User',
                        "errors" => null,
                        "content" => $usernew,
                    ];
                    return response()->json($response,201);
                }else{
                    $response = [
                        "status" => "error",
                        "message" => 'Gagal Edit User',
                        "errors" => null,
                        "content" => null,
                    ];
                    return response()->json($response,404);
                }
            }else{
                $response = [
                    "status" => "error",
                    "message" => 'Password tidak sesuai',
                    "errors" => null,
                    "content" => null,
                ];
                return response()->json($response,404);
            }
        }else{
            
            // dd($data_update);
            $user = User::where('id',$request->user_id)->update(
                $data_update
            );
            if($user){
                $usernew = User::findOrFail($request->user_id);
                    $response = [
                        "status" => "success",
                        "message" => 'Berhasil Edit User',
                        "errors" => null,
                        "content" => $usernew,
                    ];
                    return response()->json($response,201);
            }else{
                $response = [
                    "status" => "error",
                    "message" => 'Gagal Edit User',
                    "errors" => null,
                    "content" => null,
                ];
                return response()->json($response,404);
            }
        }

        $usernew = User::findOrFail($request->user_id);
                    $response = [
                        "status" => "success",
                        "message" => 'Berhasil Edit User',
                        "errors" => null,
                        "content" => $usernew,
                    ];
                    return response()->json($response,201);

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
                "message" => 'Gagal Edit User 22',
                "errors" => null,
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
                    "status" => "success",
                    "message" => 'Berhasil Edit User',
                    "errors" => null,
                    "content" => $usernew,
                ];
                return response()->json($response,201);
            }else{
                $response = [
                    "status" => "error",
                    "message" => 'Gagal Edit User 1',
                    "errors" => null,
                    "content" => null,
                ];
                return response()->json($response,404);
            }
        } catch (\Throwable $th) {
            //throw $th;
            $response = [
                "status" => "error",
                "message" => 'Gagal Edit User',
                "errors" => $th,
                "content" => null,
            ];
            return response()->json($response,404);
        }
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
