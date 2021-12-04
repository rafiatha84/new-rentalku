<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
        $users = User::orderBy('id','DESC')->get();
        // dd($users);
        $pemiliks = User::where('role','pemilik')->orderBy('id','DESC')->get();
        return view('admin.dashboard',[
            'users' => $users,
            'pemiliks' => $pemiliks
        ]);
    }
}
