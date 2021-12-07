<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;

class UserProfileController extends Controller
{
    public function index(){
        return view('user.profile');
    }
    public function edit(){
        return view('user.profile-edit');
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
                    return redirect()->route('user.profile')->with([
                        'status' => 'Sukses ganti profil dan password'
                    ]);
                }else{
                    return redirect()->route('user.profile.edit')->with([
                        'status' => 'Gagal update profil'
                    ]);
                }
            }else{
                return redirect()->route('user.profile.edit')->with([
                    'status' => 'Password lama tidak sesuai'
                ]);
            }
        }else{
            
            // dd($data_update);
            $user = User::where('id',$request->user_id)->update(
                $data_update
            );
            if($user){
                return redirect()->route('user.profile')->with([
                    'status' => 'Sukses ganti profil'
                ]);
            }else{
                return redirect()->route('user.profile.edit')->with([
                    'status' => 'Gagal update profil'
                ]);
            }
        }
    }
}
