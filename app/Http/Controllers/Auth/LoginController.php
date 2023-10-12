<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\LoginHistoryUser;
use App\User;
use Jenssegers\Agent\Facades\Agent;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
// public function index(Request $request){
//   print_r($request->all());
// }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

   


    // Working code 
    // public function redirectTo()
    // {
    //     $user = Auth::user();

    //     if ($user) 
    //     {
    //         $role = $user->role_type;

    //         switch ($role) 
    //         {
    //             case 'admin':
    //                 return '/admin';
    //                 break;
    //             case 'user':
    //                 $loginHistory = new LoginHistoryUser();
    //                 $loginHistory->user_id = $user->id;
    //                 $loginHistory->login_time = now();
    //                 $loginHistory->save();
    //                 return '/home';
    //                 break;
    //             default:
    //                 return '/';
    //                 break;
    //         }
    //     } else {
    //         return '/';
    //     }
    // }


    public function redirectTo()
    {
        
        $user = Auth::user();
    
        if ($user) 
        {
            $role = $user->role_type;
    
            switch ($role) 
            {
            
                case 'admin':
                    return '/admin';
                    break;
                case 'user':
                    // Get the user's IP address
                    $ipAddress = request()->ip();
                    // dd($ipAddress);
    
                    // Create a new login history record
                    $loginHistory = new LoginHistoryUser();
                    $loginHistory->user_id = $user->id;
                    $loginHistory->login_time = now();
                    $loginHistory->ip_address = $ipAddress;
                    // dd(new Agent);
                    $loginHistory->browser = Agent::browser();
                    // dd($loginHistory->browser);

                    // $loginHistory->browser = $browser;
                    $loginHistory->save();
    
                    return '/home';
                    break;
                default:
                    return '/';
                    break;
            }
        } else {
            return '/';
        }
    }
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}