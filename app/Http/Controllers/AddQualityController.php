<?php

namespace App\Http\Controllers;

use App\CustomManual;
use App\User;
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
        $userid = Auth::user()->id;
        $message = $request->input('message');
        $status = $request->input('status');

        $existingPolicy = CustomManual::where('user_id', $userid)->where('status', 1)->first();

        if ($existingPolicy) {
            $existingPolicy->message = $message;
            $existingPolicy->save();
        } else {
            $custommanual = new CustomManual();
            $custommanual->message = $message;
            $custommanual->status = $status;
            $custommanual->user_id = $userid;
            $custommanual->save();
        }

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
            $userAddPolicy = CustomManual::where('user_id', $userid)
                ->where('status', 1)
                ->get();
    
            $previousPolicy = $userAddPolicy->first();
    
            return view('dashboard.mannual_policy.quality_policy', compact('companyName', 'previousPolicy', 'userAddPolicy'));
        }
    

    public function add_environmental_policy(Request $request)
    {
        $userid = Auth::user()->id;
        $message = $request->input('message');
        $status = $request->input('status');

        $existingPolicy = CustomManual::where('user_id', $userid)->where('status', 2)->first();

        if ($existingPolicy) {
            $existingPolicy->message = $message;
            $existingPolicy->save();
        } else {
            $custommanual = new CustomManual();
            $custommanual->message = $message;
            $custommanual->status = $status;
            $custommanual->user_id = $userid;
            $custommanual->save();
        }

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

   public function enviornment_policy(Request $request)
        {
            $userid = Auth::user()->id;
            $companyName = Auth::user()->company_name;
            $userAddPolicy = CustomManual::where('user_id', $userid)
                ->where('status', 2)
                ->get();
    
            $previousPolicy = $userAddPolicy->first();
    
            return view('dashboard.mannual_policy.enviornment_policy', compact('companyName', 'previousPolicy', 'userAddPolicy'));
        }




        public function add_health_policy(Request $request)
        {
            $userid = Auth::user()->id;
            $message = $request->input('message');
            $status = $request->input('status');

            $existingPolicy = CustomManual::where('user_id', $userid)->where('status', 3)->first();

            if ($existingPolicy) {
                $existingPolicy->message = $message;
                $existingPolicy->save();
            } else {
                $custommanual = new CustomManual();
                $custommanual->message = $message;
                $custommanual->status = $status;
                $custommanual->user_id = $userid;
                $custommanual->save();
            }

            return back();
        }

    public function health_policy(Request $request)
        {
            $userid = Auth::user()->id;
            $companyName = Auth::user()->company_name;
            $userAddPolicy = CustomManual::where('user_id', $userid)
                ->where('status', 3)
                ->get();

            $previousPolicy = $userAddPolicy->first();

            return view('dashboard.mannual_policy.health_safety_policy', compact('companyName', 'previousPolicy', 'userAddPolicy'));
        }   
}
