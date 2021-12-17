<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Hash;
use Validator;

class PemilikProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('user');
    }

    public function register(){
        $user = User::findOrFail(Auth::user()->id);
        return view('user.auth.register-pemilik',[
        'user' => $user
        ]);
    }
    public function register_action(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'id' => 'required|integer',
            'name' => 'required',
            'nik' => 'required',
            'foto_ktp' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($validator->fails())
        {
            // dd($validator->errors());
            return redirect()->route('pemilik.register');
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
                return redirect()->route('pemilik.dashboard')->with([
                    'status' => 'Sukses ganti profil dan password'
                ]);
            }else{
                DB::rollback();
                // dd('gatau');
                return redirect()->route('pemilik.register')->with([
                    'status' => 'Gagal update profil'
                ]);
            }
        }catch(\Exception $e){
            // dd($e);
            DB::rollback();
            return redirect()->route('pemilik.register'); 
        }
    }
    public function index(){
        return view('pemilik.profile');
    }
    public function edit(){
        return view('pemilik.profile-edit');
    }
    public function edit_action(Request $request)
    {
        $request->validate([
            'user_id' => 'required'
        ]);
        // dd($request->has('image'));
        $cek = User::findOrFail($request->user_id);
        $data_update = $request->only(['name','telp','alamat','email']);
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
                    return redirect()->route('pemilik.profile')->with([
                        'status' => 'Sukses ganti profil dan password'
                    ]);
                }else{
                    return redirect()->route('pemilik.profile.edit')->with([
                        'status' => 'Gagal update profil'
                    ]);
                }
            }else{
                return redirect()->route('pemilik.profile.edit')->with([
                    'status' => 'Password lama tidak sesuai'
                ]);
            }
        }else{
            
            // dd($data_update);
            $user = User::where('id',$request->user_id)->update(
                $data_update
            );
            if($user){
                return redirect()->route('pemilik.profile')->with([
                    'status' => 'Sukses ganti profil'
                ]);
            }else{
                return redirect()->route('pemilik.profile.edit')->with([
                    'status' => 'Gagal update profil'
                ]);
            }
        }
    }
}