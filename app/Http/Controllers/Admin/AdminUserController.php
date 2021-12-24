<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengemudi;
use App\Models\Dompet;
use Hash;

class AdminUserController extends Controller
{
    public function create(Request $request){
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        if($request->has('foto_ktp')){
            $uploadFolder = "image/foto_ktp/";
            $image = $request->file('foto_ktp');
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path($uploadFolder), $imageName);
            $image_link = $uploadFolder.$imageName;
            $data['foto_ktp'] = $image_link;
        }
        if($request->has('foto_sim')){
            $uploadFolder = "image/foto_sim/";
            $image = $request->file('foto_sim');
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path($uploadFolder), $imageName);
            $image_link = $uploadFolder.$imageName;
            $data['foto_sim'] = $image_link;
        }

        $user = User::create($data);
        if($user){
            $dompet = new Dompet();
            $dompet->user_id = $user->id;
            $dompet->saldo = 0;
            $dompet->save();
            if($request->role == "pengemudi"){
                $pengemudi = Pengemudi::create([
                    'user_id' => $user->id,
                    'owner_id' => $request->owner_id,
                    'harga' => 100000
                ]);
            }
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('admin.dashboard');
        }
        

    }
    public function update(Request $request,$id){
        $cek = User::findOrFail($id);
        $data = $request->all();
        unset($data['_token']);
        if($data['password'] != null){
            $data['password'] = Hash::make($request->password);
        }else{
            unset($data['password']);
        }
        // dd($data);
        if($request->has('foto_ktp')){
            $uploadFolder = "image/foto_ktp/";
            $image = $request->file('foto_ktp');
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path($uploadFolder), $imageName);
            $image_link = $uploadFolder.$imageName;
            $data['foto_ktp'] = $image_link;
        }
        if($request->has('foto_sim')){
            $uploadFolder = "image/foto_sim/";
            $image = $request->file('foto_sim');
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path($uploadFolder), $imageName);
            $image_link = $uploadFolder.$imageName;
            $data['foto_sim'] = $image_link;
        }
        $update = User::where('id',$id)->update($data);
        if($update){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('admin.dashboard');
        }
    }
    public function delete($id){
        // dd($id);
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.dashboard');
    }
}
