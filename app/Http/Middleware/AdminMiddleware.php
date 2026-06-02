<?php

namespace App\Http\Middleware;
use Auth;


use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
  
    public function handle($request, Closure $next) {
      if(Auth::user()->role_type=='admin'){

         return $next($request);
      }
      return redirect('/home');
      //   if (Auth::guard($guard)->check()) {
      //     $role = Auth::user()->role_type; 
      
      //     switch ($role) {
      //       case 'admin':
      //          return redirect('/admin');
      //          break;
      //       case 'user':
      //          return redirect('/home');
      //          break; 
      
      //       default:
      //          return redirect('/'); 
      //          break;
      //     }
      //   }
      //   return $next($request);
      }
}
