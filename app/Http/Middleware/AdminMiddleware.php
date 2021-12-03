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
            return redirect("admin/login")->with('status','You are not allowed to access');
        }else{
            if(Auth::user()->role != "admin"){  
                return redirect("admin/login")->with('status','You are not allowed to access');
            }
        }
        return $next($request);
    }
}
