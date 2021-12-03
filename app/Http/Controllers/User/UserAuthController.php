<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserAuthController extends Controller
{

    public function index()
    {
        return view('user.auth.login');
    }  
      

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if(Auth::user()->role == "pemilik"){
                return redirect()->route('pemilik.dashboard');
            }else{
                return redirect()->intended('dashboard')->withSuccess('Signed in');
            }
            
        }
  
        return redirect("login")->with('status','Login details are not valid');
    }



    public function registration()
    {
        return view('user.auth.register');
    }
      

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
        if($check){
            //membuat user role sebagi penyewa
            UserRole::create([
                'user_id' => $check->id,
                'role_tipe_id' => '1'
            ]);
        }
        
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
           
            return redirect("dashboard")->withSuccess('You have signed-in');
        }

        return redirect("login")->with('status','Gagal Mendaftar');
        
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    

    public function dashboard()
    {
        if(Auth::check()){
            return view('user.dashboard');
        }
  
        return redirect("login")->with('status','You are not allowed to access');
    }
    public function dashboard_pemilik()
    {
        if(Auth::check()){
            return view('user.dashboard-pemilik');
        }
  
        return redirect("login")->with('status','You are not allowed to access');
    }
    

    public function logOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}