<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->booted(function () {
            $req = request();
            if ($req && $req->path() !== '/' && (
                str_starts_with($req->path(), 'edit_user')
                || str_starts_with($req->path(), 'ProcessCheck')
                || str_starts_with($req->path(), 'AuditsCheck')
                || str_starts_with($req->path(), 'requiremntCheck')
                || str_starts_with($req->path(), 'nonConformCheck')
                || str_starts_with($req->path(), 'customerCheck')
                || str_starts_with($req->path(), 'customerReviewad')
                || str_starts_with($req->path(), 'supplierCheck')
                || str_starts_with($req->path(), 'calibrationcheck')
                || str_starts_with($req->path(), 'chemicalcheck')
                || str_starts_with($req->path(), 'EmployeCheck')
                || str_starts_with($req->path(), 'managementCheck')
                || str_starts_with($req->path(), 'maintainRecCheck')
                || str_starts_with($req->path(), 'AccidentCheck')
                || str_starts_with($req->path(), 'riskAssesmntCheck')
                || str_starts_with($req->path(), 'workinstructionCheck')
                || str_starts_with($req->path(), 'additionalpolicies')
                || str_starts_with($req->path(), 'interested_parties')
                || str_starts_with($req->path(), 'login')
            )) {
                Log::error('REQUEST TRACE', [
                    'url'        => $req->fullUrl(),
                    'method'     => $req->method(),
                    'referer'    => $req->headers->get('referer'),
                    'auth_check' => Auth::check(),
                    'auth_id'    => Auth::id(),
                    'session_id' => $req->hasSession() ? $req->session()->getId() : null,
                    'has_cookie' => $req->cookies->has(config('session.cookie')),
                ]);
            }
        });
    }
}
