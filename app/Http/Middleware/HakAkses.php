<?php

namespace App\Http\Middleware;

use Closure;

class HakAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $namaRole)
    {
        // if(auth()->check() && !auth()->user()->rules($namaRole)){
        //     return redirect('/aksesKhusus');
        // }
        // return $next($request);
    }
}
