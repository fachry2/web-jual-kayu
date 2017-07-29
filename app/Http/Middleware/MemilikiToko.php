<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class MemilikiToko
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
        //$user = Auth::user();
        if(Auth::check()){
            if(!Auth::guard('admin')->check()){
                if(Auth::user()->milikiUsaha())
                    return $next($request);
            }else{
                return $next($request);
            }
        }
        return $next($request);
    }
}
