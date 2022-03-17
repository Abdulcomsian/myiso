<?php

namespace App\Http\Controllers;

use App\requirement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use SweetAlert;

class RequiremntController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $userid=Auth::user()->id;
        $requirement=requirement::where('user_id',$userid)->get();
        return view('dashboard.form_records.requirements_aspect',compact('requirement'));
      //  return view('dashboard.form_records.requirements_aspect',compact('requirement'));
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
        // print_r($request->all());
        $this->validate($request,[
            'requirement'=>'required',
            'completiondate'=>'required',
            'month'=>'required',
        ]);
        $duedate=$request->input('month');
        $completionDate=$request->input('completiondate');
        $effectiveDate = date('Y-m-d', strtotime($completionDate . "'.$duedate.' months") );
        $next_due_date = date('d-m-Y', strtotime($completionDate. ' +30 days'));
        // echo $next_due_date;
        try{
            $requirement= new requirement();
            $requirement->user_id=Auth()->user()->id;
             $requirement->requirment_title=$request->input('requirement');
             $requirement->completion_date=$request->input('completiondate');
             $requirement->periods=$request->input('month');
             $requirement->due_date=$next_due_date;
             $requirement->save();
            //  SweetAlert::message('Robots are working!');
             return redirect('/requirements_aspect')->with("Success","Data Save Successfully");
        }catch(Exception $exc){

        }




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id=$request->requirment_id;

        $requirement= requirement::find($id);
        $requirement->user_id=Auth()->user()->id;
        $duedate=$request->input('periods');
        $completionDate=$request->input('completion_date');
        $effectiveDate = date('Y-m-d', strtotime($completionDate . "'.$duedate.' months") );
        $next_due_date = date('d-m-Y', strtotime($completionDate. ' +30 days'));
        $requirement->requirment_title=$request->input('requirment_title');
        $requirement->completion_date=$request->input('completion_date');
        $requirement->periods=$request->input('periods');
        $requirement->due_date=$next_due_date;
        $requirement->save();
        //sign them in
        $notification = [
            'message' => 'Record  updated successfully.!',
            'alert-type' => 'success'
        ];
        return redirect('/requirements_aspect')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {

        $id=$req->id;
        $req=requirement::find($id)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];
        return redirect('/requirements_aspect')->with($notification);

    }
}
