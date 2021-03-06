<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class userMiddleware
{
    /**
     * Handle an  incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role_type=='user'){

            return $next($request);
         }
         return redirect('/admin');
        // return $next($request);
    }
}
