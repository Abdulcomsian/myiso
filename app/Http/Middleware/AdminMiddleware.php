<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
      if (!Auth::check()) {
          Log::error('AdminMiddleware: no auth', [
              'url'         => $request->fullUrl(),
              'referer'     => $request->headers->get('referer'),
              'ip'          => $request->ip(),
              'user_agent'  => $request->userAgent(),
              'session_id'  => $request->hasSession() ? $request->session()->getId() : null,
              'has_cookie'  => $request->cookies->has(config('session.cookie')),
          ]);
          return redirect('/login');
      }
      if (Auth::user()->role_type === 'admin') {
         return $next($request);
      }
      Log::error('AdminMiddleware: not admin role', [
          'url'       => $request->fullUrl(),
          'user_id'   => Auth::id(),
          'role_type' => Auth::user()->role_type,
      ]);
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
