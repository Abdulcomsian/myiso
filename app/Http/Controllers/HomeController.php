<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }




    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = \Auth::user()->id;

        $user = User::find($id);

        // Compute days since the PREVIOUS last_login (before we overwrite it)
        $showInactivityAlert = false;
        if ($user->last_login) {
            $daysInactive = \Carbon\Carbon::parse($user->last_login)->diffInDays(now());
            if ($daysInactive >= 90) {
                $showInactivityAlert = true;
            }
        }

        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        return view('dashboard.index', compact('user', 'showInactivityAlert'));
    }
    
    public function usertype(){
        $userType=Auth()->users()->role_type;
        if($userType =='admin'){
            return view('dashboard.admin.index');
        }else{
            return view('dashboard.index');
        }
    }
}
