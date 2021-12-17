<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Dompet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails()){
            $response = [
                "status" => "error",
                "message" => 'Validator Error',
                "errors" => $validator->errors(),
                "content" => null,
            ];
            return response()->json($response,404);       
        }

        DB::beginTransaction();
        try{
            //create user
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            // create dompet
            $dompet = new Dompet();
            $dompet->user_id = $user->id;
            $dompet->saldo = 0;
            $dompet->save();
            //commit
            DB::commit();
            $token = $user->createToken('auth_token')->plainTextToken;
            $response = [
                'status' => 'success',
                'msg' => 'Register successfully',
                'errors' => null,
                'content' => [
                    "status_code" => 200,
                    "access_token" => $token,
                    "token_type" => "Bearer"
                ],
            ];
            return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
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

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|max:255',
            'password' => 'required|string'
        ]);

        if($validator->fails()){
            $response = [
                "status" => "error",
                "message" => 'Validator Error',
                "errors" => $validator->errors(),
                "content" => null,
            ];
            return response()->json($response,200);       
        }

        if (!Auth::attempt($request->only('email', 'password')))
        {
            $response = [
                "status" => "error",
                "message" => "Unauthorized",
                "errors" => null,
                "content" => null,
            ];
            return response()
                ->json($response, 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;
        $response = [
            "status" => "success",
            "message" => "Login Succefully",
            "errors" => null,
            "content" => [
                "status_code" => 200,
                "access_token" => $token,
                "token_type" => "Bearer"
            ],
        ];
        return response()->json($response,200);
    }

    // method for user logout and delete token
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        $response = [
            'status' => 'success',
            'msg' => 'Logout successfully',
            'errors' => null,
            'content' => null,
        ];

        return response()->json($response,200);
    }
    public function logoutall(Request $request) {
        $user = $request->user();
        $user->tokens()->delete();
        $response = [
            'status' => 'success',
            'msg' => 'Logout successfully',
            'errors' => null,
            'content' => null,
        ];
        return response()->json($response, 200,[
                'Content-Type' => 'application/json',
                'Charset' => 'utf-8'
            ]);
    }
    public function me(Request $request)
    {
        return $request->user();
    }

    public function user()
    {
        $user = User::with('avgRating')->where('id',Auth::user()->id)->firstOrFail();
        return $user;
    }

    public function register_pemilik(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'id' => 'required|integer',
            'name' => 'required',
            'nik' => 'required',
            'foto_ktp' => 'required|image:jpeg,png,jpg,gif,svg'
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
        DB::beginTransaction();
        try{
            $cek = User::findOrFail($request->id);
            $data_update = $request->only(['name','nik']);
            if($request->has('foto_ktp'))
            {
                $uploadFolder = "image/foto_ktp/";
                $image = $request->file('foto_ktp');
                $imageName = time().'-'.$image->getClientOriginalName();
                $image->move(public_path($uploadFolder), $imageName);
                $data_update['foto_ktp'] = $uploadFolder.$imageName;
            }
            $data_update['role'] = "pemilik";
            $user = User::where('id',$request->id)->update(
                $data_update
            );
            if($user){
                DB::commit();
                $user = User::where('id',$request->id)->first();
                $response = [
                    "status" => "success",
                    "message" => 'Berhasil Daftar sebagai pemilik',
                    "errors" => null,
                    "content" => $user,
                ]; 
                return response()->json($response,201);
            }else{
                DB::rollback();
                $response = [
                    "status" => "error",
                    "message" => 'Gagal Daftar sebagai pemilik',
                    "errors" => null,
                    "content" => null,
                ]; 
                return response()->json($response,404);
            }
        }catch(\Exception $e){
            DB::rollback();
            $response = [
                "status" => "error",
                "message" => 'Gagal Daftar sebagai pemilik',
                "errors" => $e,
                "content" => null,
            ]; 
            return response()->json($response,404);
        }
    }
}