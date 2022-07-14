<?php

namespace App\Http\Middleware;

use Closure;

class IsItinfra
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
        if (auth()->user() && auth()->user()->role_type == 'Itinfra' && auth()->user()->active == '1') {
            return $next($request);
        }
        return redirect('/');
    }
}
