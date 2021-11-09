<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
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
        if(auth()->user()){
        if(auth()->user()->is_admin == 1){
            return $next($request);
        }
        }else{
            return redirect('login')->with('error',"You don't have login please login.");
        }
   
        return redirect('home')->with('error',"You don't have admin access.");
    }
}
