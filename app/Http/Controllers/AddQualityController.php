<?php

namespace App\Http\Controllers;

use App\CustomManual;
use App\User;
use App\AddUsers;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class AddQualityController extends Controller
{
    // public function add_quality(Request $request)
    // {
    //     $message = $request->message;
    //     $status = $request->status;
    //     $userid=Auth::user()->id;

    //     $custommannual= new CustomManual();
    //     $custommannual->message=$message;
    //     $custommannual->status=$status;
    //     $custommannual->user_id= $userid;
    //     $custommannual->save();
    //     return back();

    // }

    public function add_quality(Request $request)
    {
        $request->validate([
                'message' => 'required|max:10000',
            ],[
                'message.required' => 'This field is required',
            ]
        );
        // Every submit adds a new additional policy
        $custommanual = new CustomManual();
        $custommanual->message = $request->input('message');
        $custommanual->status = 1;
        $custommanual->user_id = Auth::user()->id;
        $custommanual->save();

        return back();
    }




    //   public function quality_policy(Request $request)
    //     {
    //         $userid= Auth::user()->id;
            
    //         $user=User::where('id',$userid)->first();
    //         $useraddpolicy = CustomManual::where('user_id',$userid)
    //         ->where('status', 1)
    //         ->get();
    //         return view('dashboard.mannual_policy.quality_policy',compact('user','useraddpolicy'));
    //     }

        // public function quality_policy(Request $request)
        // {
        //     $userId = Auth::user()->id;
            
        //     $user = User::where('id', $userId)->first();
        //     $userAddPolicy = CustomManual::where('user_id', $userId)
        //         ->where('status', 1)
        //         ->get();
        
        //     $previousPolicy = $userAddPolicy->last(); // Get the last added policy
        
        //     return view('dashboard.mannual_policy.quality_policy', compact('user', 'userAddPolicy', 'previousPolicy'));
        // }

        public function quality_policy(Request $request)
        {
            $userid = Auth::user()->id;
            $companyName = Auth::user()->company_name;
            // Latest first, then older ones
            $userAddPolicy = CustomManual::where('user_id', $userid)
                ->where('status', 1)
                ->orderBy('created_at', 'desc')
                ->orderBy('id', 'desc')
                ->get();

            return view('dashboard.mannual_policy.quality_policy', compact('companyName', 'userAddPolicy'));
        }
    

    public function add_environmental_policy(Request $request)
    {
        $request->validate([
                'message' => 'required|max:10000',
            ],[
                'message.required' => 'This field is required',
            ]
        );
        // Every submit adds a new additional policy (shown below the previous ones)
        $custommanual = new CustomManual();
        $custommanual->message = $request->input('message');
        $custommanual->status = 2;
        $custommanual->user_id = Auth::user()->id;
        $custommanual->save();

        return back();
    }

//     public function enviornment_policy(Request $request)
//     {
//     $userid= Auth::user()->id;
    
//     $user=User::where('id',$userid)->first();
//     $useraddpolicy = CustomManual::where('user_id',$userid)
//     ->where('status', 2)
//     ->get();
//     // dd($useraddpolicy);
//     return view('dashboard.mannual_policy.enviornment_policy',compact('user','useraddpolicy'));
//    }

   public function environment_policy(Request $request)
        {
            $userid = Auth::user()->id;
            $companyName = Auth::user()->company_name;
            // Latest first, then older ones
            $userAddPolicy = CustomManual::where('user_id', $userid)
                ->where('status', 2)
                ->orderBy('created_at', 'desc')
                ->orderBy('id', 'desc')
                ->get();

            return view('dashboard.mannual_policy.environment_policy', compact('companyName', 'userAddPolicy'));
        }

        
        public function add_health_policy(Request $request)
        {
            $request->validate([
                'message' => 'required|max:10000',
            ],[
                'message.required' => 'This field is required',
            ]);
            
            // Every submit adds a new additional policy
            $custommanual = new CustomManual();
            $custommanual->message = $request->input('message');
            $custommanual->status = 3;
            $custommanual->user_id = Auth::user()->id;
            $custommanual->save();

            return back();
        }

    public function health_policy(Request $request)
        {
            $userid = Auth::user()->id;
            $companyName = Auth::user()->company_name;
            // Latest first, then older ones
            $userAddPolicy = CustomManual::where('user_id', $userid)
                ->where('status', 3)
                ->orderBy('created_at', 'desc')
                ->orderBy('id', 'desc')
                ->get();

            return view('dashboard.mannual_policy.health_safety_policy', compact('companyName', 'userAddPolicy'));
        }
}
