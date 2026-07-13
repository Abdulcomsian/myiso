<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        Log::error('Authenticate middleware: unauthenticated', [
            'url'         => $request->fullUrl(),
            'method'      => $request->method(),
            'referer'     => $request->headers->get('referer'),
            'ip'          => $request->ip(),
            'session_id'  => $request->hasSession() ? $request->session()->getId() : null,
            'has_cookie'  => $request->cookies->has(config('session.cookie')),
            'cookie_name' => config('session.cookie'),
            'auth_check'  => Auth::check(),
            'auth_id'     => Auth::id(),
        ]);

        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
