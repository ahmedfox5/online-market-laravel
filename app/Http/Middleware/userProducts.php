<?php

namespace App\Http\Middleware;

use App\Product;
use Closure;
use http\Env\Request;

class userProducts
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
        if(auth()->user()->id === Product::find(request()->route()->parameters['id'])->user_id){
            return $next($request);
        }else{
            return redirect()->back();
        }
    }
}
