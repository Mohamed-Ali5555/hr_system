<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
  




    
    public function handle(Request $request, Closure $next)
    {
        // dd(auth()->user()->role);
        if(auth()->user()->role=='admin'){
            return $next($request);

        }else{
            return redirect()->route(auth()->user()->role)->with('error',"you dont have access");
        }
    }
}
