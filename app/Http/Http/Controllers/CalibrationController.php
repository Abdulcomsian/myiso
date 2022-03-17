<?php

namespace App\Http\Controllers;

use App\calibration;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalibrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userid=Auth::user()->id;
        $calibration=calibration::where('user_id',$userid)->get();
        return view('dashboard.form_records.calibration_record',compact('calibration'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //     $this->validate($request,[
    //        'calibrationid'=>'required',
    //    ]);
       try{
           $calibration= new calibration();
           $calibration->user_id=Auth()->user()->id;
           $calibration->calibrationid=101;
           $calibration->equipment=$request->input('equipment');
           $calibration->serialNum=$request->input('serialNum');
           $calibration->locaction=$request->input('locaction');
           $calibration->testMethod=$request->input('testMethod');
           $calibration->acceptance=$request->input('acceptance');
           $calibration->reportRev=$request->input('reportRev');
           $calibration->freq=$request->input('freq');
           $calibration->calibratedDate=$request->input('calibratedDate');
           $calibration->certificatenumber=$request->input('certificatenumber');


           $calibration->sentence=$request->input('sentence');
           $calibration->save();
           return redirect('/calibration_record')->with("Success","Data Save Successfully");
       }catch(Exception $exception){
        return redirect('/calibration_record')->with("Error","Error");

       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\calibration  $calibration
     * @return \Illuminate\Http\Response
     */
    public function show(calibration $calibration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\calibration  $calibration
     * @return \Illuminate\Http\Response
     */
    public function edit(calibration $calibration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\calibration  $calibration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id=$request->id;

        try{
            $calibration=calibration::find($id);
            $calibration->user_id=Auth()->user()->id;
            // $calibration->calibrationid=$request->input('calibrationid');
            $calibration->equipment=$request->input('equipment');
            $calibration->serialNum=$request->input('serialNum');
            $calibration->locaction=$request->input('locaction');
            $calibration->testMethod=$request->input('testMethod');
            $calibration->acceptance=$request->input('acceptance');
            $calibration->reportRev=$request->input('reportRev');
            $calibration->freq=$request->input('freq');
            $calibration->calibratedDate=$request->input('calibratedDate');
            $calibration->certificatenumber=$request->input('certificatenumber');
            $calibration->sentence=$request->input('sentence');
            $calibration->save();
             $notification = [
                'message' => 'Record  updated successfully.!',
                'alert-type' => 'success'
            ];
             return redirect('/calibration_record')->with($notification);
        }catch(Exception $exc){
            print_r($exc->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\calibration  $calibration
     * @return \Illuminate\Http\Response
     */
    public function destroy(calibration $calibration)
    {
        //
    }
}
