<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() &&  Auth::user()->ac_status==0) {
            echo "Not Verified";
            return $next($request);
        }
       elseif(Auth::check() &&  Auth::user()->ac_status==1) {
        
            return $next($request);
        }
        elseif(Auth::check() &&  Auth::user()->ac_status==2) {
        
            return $next($request);
        }
        
        

    }
}
