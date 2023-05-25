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
    public function add_quality(Request $request)
    {
        $message = $request->message;
        $status = $request->status;
        $userid=Auth::user()->id;

        $custommannual= new CustomManual();
        $custommannual->message=$message;
        $custommannual->status=$status;
        $custommannual->user_id= $userid;
        $custommannual->save();
        return back();
        // return redirect('/add_quality')->with("Success","Data Save Successfully");
    }

    public function quality_policy(Request $request)
            {
            $userid= Auth::user()->id;
            
            $user=User::where('id',$userid)->first();
            $useraddpolicy = CustomManual::where('user_id',$userid)
            ->where('status', 1)
            ->get();
            return view('dashboard.mannual_policy.quality_policy',compact('user','useraddpolicy'));
           }

            // public function get_add_quality(Request $request)
            // {
            //     $userid=Auth::user()->id;
            //     $addquality=CustomManual::where('user_id',$userid)->orderBy('id','DESC')->get();
            //     return view('dashboard.mannual_policy.quality_policy');
            // }


    public function add_environmental_policy(Request $request)
    {
         $message = $request->message;
         $status = $request->status;
         $userid=Auth::user()->id;
    
         $custommannual= new CustomManual();
         $custommannual->message=$message;
         $custommannual->status=$status;
         $custommannual->user_id=$userid;
         $custommannual->save();
         return back();
    }

    public function enviornment_policy(Request $request)
    {
    $userid= Auth::user()->id;
    
    $user=User::where('id',$userid)->first();
    $useraddpolicy = CustomManual::where('user_id',$userid)
    ->where('status', 2)
    ->get();
    // dd($useraddpolicy);
    return view('dashboard.mannual_policy.enviornment_policy',compact('user','useraddpolicy'));
   }





    public function Add_Health_Safety_Policy(Request $request)
    {
         $message = $request->message;
         $status = $request->status;
         $userid=Auth::user()->id;
    
         $custommannual= new CustomManual();
         $custommannual->message=$message;
         $custommannual->status=$status;
         $custommannual->user_id=$userid;
         $custommannual->save();
         return back();
    }
}
