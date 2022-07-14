<?php

namespace App\Http\Middleware;

use Closure;

class IsAllLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {       
        if(auth()->user()->role_type == "Admin" && auth()->user()->active == '1') {
            return $next($request);
        }elseif(auth()->user()->role_type == "Site Admin" && auth()->user()->active == '1'){
            return $next($request);
        }elseif(auth()->user()->role_type == "Buddy" && auth()->user()->active == '1'){
            return $next($request);
        }elseif(auth()->user()->role_type == "can" && auth()->user()->active == '1'){
            return $next($request);
        }elseif(auth()->user()->role_type == "HR" && auth()->user()->active == '1'){
            return $next($request);
        }elseif(auth()->user()->role_type == "Itinfra" && auth()->user()->active == '1'){
            return $next($request);
        }

        return redirect('/');
    }
}
