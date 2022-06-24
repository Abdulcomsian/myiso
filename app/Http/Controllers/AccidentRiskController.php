<?php

namespace App\Http\Controllers;

use App\AccidentRisk;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccidentRiskController extends Controller
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
    public function index()
    {
        $userid=Auth::user()->id;
        $audit=AccidentRisk::where('user_id',$userid)->orderBy('id','DESC')->get();
        return view('dashboard.form_records.accident_risk_assesment',compact('audit'));
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

        $this->validate($request,[
            'activityscenario'=>'required',

        ]);

        // try{
            $Audit= new AccidentRisk();
            // $is_admin = $request->input('is_admin');
      if(Auth::check() && Auth::user()->role_type == "admin"){
            $the_id = intval($request->input('user_id'));
       }else{
           $the_id = Auth()->user()->id;
       } 
            $Audit->user_id= $the_id;
             $Audit->activityscenario=$request->input('activityscenario');
             $Audit->risklikehood=$request->input('risklikehood');
             $Audit->riskseverity=$request->input('riskseverity');
             $Audit->envaccident=$request->input('envaccident');
             $Audit->envaccidental=$request->input('envaccidental');
             $Audit->consequences=$request->input('consequences');
             $Audit->reducerisk=$request->input('reducerisk');
             $Audit->revisedrisk=$request->input('revisedrisk');
             $Audit->reviseRiskSever=$request->input('reviseRiskSever');

             $Audit->save();

             return back()->with("Success","Data Save Successfully");
        // }catch(Exception $exc){
        //     print_r($exc->getMessage());
        // }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AccidentRisk  $accidentRisk
     * @return \Illuminate\Http\Response
     */
    public function show(AccidentRisk $accidentRisk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AccidentRisk  $accidentRisk
     * @return \Illuminate\Http\Response
     */
    public function edit(AccidentRisk $accidentRisk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AccidentRisk  $accidentRisk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id=$request->id;
        // try{
            $Audit= AccidentRisk::find($id);
 if(Auth::check() && Auth::user()->role_type == "admin"){
            $the_id = intval($request->input('user_id'));
       }else{
           $the_id = Auth()->user()->id;
       } 
            $Audit->user_id= $the_id;
             $Audit->activityscenario=$request->input('activityscenario');
             $Audit->risklikehood=$request->input('risklikehood');
             $Audit->riskseverity=$request->input('riskseverity');
             $Audit->envaccident=$request->input('envaccident');
             $Audit->envaccidental=$request->input('envaccidental');
             $Audit->consequences=$request->input('consequences');
             $Audit->reducerisk=$request->input('reducerisk');
             $Audit->revisedrisk=$request->input('revisedrisk');
             $Audit->reviseRiskSever=$request->input('reviseRiskSever');

             $Audit->save();
             $notification = [
                'message' => 'Record  updated successfully.!',
                'alert-type' => 'success'
            ];
             return back()->with($notification);
        // }catch(Exception $exc){
        //     print_r($exc->getMessage());
        // }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AccidentRisk  $accidentRisk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {

        $id=$req->id;
        $req=AccidentRisk::find($id)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];
        return  back()->with($notification);

    }
}
