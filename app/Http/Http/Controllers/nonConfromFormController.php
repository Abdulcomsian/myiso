<?php

namespace App\Http\Controllers;

use App\Nonconform;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class nonConfromFormController extends Controller
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
    public function index(Request $request)
    {
        $userid=Auth::user()->id;
        $nonconform=Nonconform::where('user_id',$userid)->get();
        return view('dashboard.form_records.non_conformities',compact('nonconform'));
    }

    /**
     * Show the form for creatings a new resource.
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

       try{
           $nonConform= new Nonconform();
           $nonConform->user_id=Auth()->user()->id;
           $nonConform->customerID=124;
           $nonConform->description=$request->input('description');
           $nonConform->rootCause=$request->input('rootCause');
           $nonConform->immediateCorp=$request->input('immediateCorp');
           $nonConform->actionPrevent=$request->input('actionPrevent');
           $nonConform->ActionRecurnce=$request->input('ActionRecurnce');
           $nonConform->effectiveDate=$request->input('effectiveDate');
           $nonConform->reviewdBy=$request->input('reviewdBy');
           $nonConform->dateNcP=$request->input('dateNcP');
           $nonConform->dateNcR=$request->input('dateNcR');
           $nonConform->CRE=$request->input('CRE');
           $nonConform->PI=$request->input('PI');
           $nonConform->root_cause_category=$request->input('root_cause_category');
           $nonConform->save();
           return redirect('/non_confromities')->with("Success","Data Save Successfully");
       }catch(Exception $exception){
           print_r($exception);
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
        $id=$request->id;
        $nonConform=Nonconform::find($id);
        // $nonConform->user_id=Auth()->user()->id;
        // $nonConform->customerID=$request->input('customerID');
        $nonConform->description=$request->input('description');
        $nonConform->rootCause=$request->input('rootCause');
        $nonConform->immediateCorp=$request->input('immediateCorp');
        $nonConform->actionPrevent=$request->input('actionPrevent');
        $nonConform->ActionRecurnce=$request->input('ActionRecurnce');
        $nonConform->effectiveDate=$request->input('effectiveDate');
        $nonConform->reviewdBy=$request->input('reviewdBy');
        $nonConform->dateNcP=$request->input('dateNcP');
        $nonConform->dateNcR=$request->input('dateNcR');
        $nonConform->CRE=$request->input('CRE');
        $nonConform->PI=$request->input('PI');
        $nonConform->root_cause_category=$request->input('root_cause_category');
        $nonConform->save();
        return redirect('/non_confromities')->with("Success","Data Save Successfully");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
