<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user() == null){
            return redirect("admin/login")->with('status','Anda tidak diizinkan untuk mengakses');
        }else{
            if(Auth::user()->role != "admin"){  
                return redirect("admin/login")->with('status','Anda tidak diizinkan untuk mengakses');
            }
        }
        return $next($request);
    }
}
