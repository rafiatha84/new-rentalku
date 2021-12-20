<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Dompet;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Validator;

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
            if (Auth::user()->role == "pemilik") {
                return redirect()->route('pemilik.dashboard');
            } else {
                return redirect()->intended('dashboard')->withSuccess('masuk');
            }
        }
        return redirect("login")->with('status', 'Detail login tidak valid');
    }

    public function registration()
    {
        return view('user.auth.register');
    }

    public function customRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect("registration")->with('status', $validator->errors()->first());
        }
        DB::beginTransaction();
        try {
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
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                if (Auth::user()->role == "pemilik") {
                    return redirect()->route('pemilik.dashboard');
                } else {
                    return redirect()->intended('dashboard')->withSuccess('masuk');
                }
            }
            return redirect("registration")->with('status', 'Gagal Mendaftar');
        } catch (\Exception $e) {
            return redirect("login")->with('status', 'Gagal Mendaftar');
        }

    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('user.dashboard');
        }

        return redirect("login")->with('status', 'Anda tidak diizinkan untuk mengakses');
    }
    public function dashboard_pemilik()
    {
        if (Auth::check()) {
            return view('user.dashboard-pemilik');
        }

        return redirect("login")->with('status', 'Anda tidak diizinkan untuk mengakses');
    }

    public function logOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
