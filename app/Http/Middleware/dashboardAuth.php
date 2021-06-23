<?php

namespace App\Http\Middleware;

use Closure;

class dashboardAuth
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
        if(auth()->user()->job <= 2) {
            return $next($request);
        }else{
            return redirect()->to('/');
        }
    }
}
