<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DruAccessMiddleware
{
    /**
     * Allow super_admin, or any user holding one of the given access control codes.
     * Usage: ->middleware('dru-access') for super_admin only, ->middleware('dru-access:dru_pa,dru_pa_s')
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$codes)
    {
        if(!user()){
            abort(403, "Anda tiada kebenaran untuk mengakses halaman ini.");
        }
        if(user()->role == 'super_admin'){
            return $next($request);
        }
        foreach ($codes as $code) {
            if(getAccessControl($code)){
                return $next($request);
            }
        }
        abort(403, "Anda tiada kebenaran untuk mengakses halaman ini.");
    }
}
