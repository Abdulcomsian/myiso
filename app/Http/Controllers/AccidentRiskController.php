<?php

namespace App\Http\Controllers;

use App\AccidentRisk;
use App\Helpers\HelperFunctions;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

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
             $Audit->any_issues=$request->input('any_issues');
             //Check if user attach evidence
             if ($request->file('attach_evidence') && Schema::hasColumn('tbl_accident_risks','attach_evidence')) {
                //Delete previous attach evidence if exist
                $file = $request->file('attach_evidence');
                $path = '/uploads/user/attach_evidence/';
                $Audit->attach_evidence = HelperFunctions::saveFile($path,$file);
             }
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
        $any_issues = $request->input('any_issues');
        if($any_issues==NULL){
            $any_issues="";
        }
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
             $Audit->any_issues=$any_issues;
            //Check if user attach evidence
            if ($request->file('attach_evidence') && Schema::hasColumn('tbl_accident_risks','attach_evidence')) {
                //Delete previous attach evidence if exist
                if (File::exists(public_path($Audit->attach_evidence))) {
                    File::delete(public_path($Audit->attach_evidence));
                }

                $file = $request->file('attach_evidence');
                $path = '/uploads/user/attach_evidence/';
                $Audit->attach_evidence = HelperFunctions::saveFile($path,$file);
            }

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
        $risk=AccidentRisk::find($id);
        if (File::exists(public_path($risk->attach_evidence))) {
            File::delete(public_path($risk->attach_evidence));
        }
        $risk->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];
        return  back()->with($notification);

    }
}
