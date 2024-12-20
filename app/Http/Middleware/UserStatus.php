<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

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
            // return $next($request);
       if (Auth::user()->ac_status==0) {
            return redirect('/verify');
       }
       elseif (Auth::user()->ac_status==1) {
            // return redirect('/verify');
            return $next($request);
       }
       else{
        return redirect('/block');
       }
        
        

    }
}
