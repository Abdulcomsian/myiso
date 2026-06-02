<?php

namespace App\Http\Controllers;

use App\Helpers\HelperFunctions;
use App\Maintain_rec;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class MaintainRecController extends Controller
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
        $userinfo=Maintain_rec::where('user_id',$userid)->orderBy('id','DESC')->get();
        return view('dashboard.form_records.maintance_record',compact('userinfo'));
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
        // try{
            // $this->validate($request,[
            //     'mid'=>'required'
            // ]);
            $mrecord= new Maintain_rec();
            $mrecord->mid=142;
      if(Auth::check() && Auth::user()->role_type == "admin"){
            $the_id = intval($request->input('user_id'));
       }else{
           $the_id = Auth()->user()->id;
       }  //dd( $the_id );
            $mrecord->user_id= $the_id;
            $mrecord->mrdate=$request->input('mrdate');
            $mrecord->mritem=$request->input('mritem');
            $mrecord->mractivity=$request->input('mractivity');
            $mrecord->mlocation=$request->input('mlocation');
            $mrecord->mrobservation=$request->input('mrobservation');
            $mrecord->mractions=$request->input('mractions');
            $mrecord->mractivityperofrmby=$request->input('mractivityperofrmby');
            $mrecord->any_issues=$request->input('any_issues');
        //Check if user attach evidence
            if ($request->file('attach_evidence') && Schema::hasColumn('tbl_maintain_recs','attach_evidence')) {
                //Delete previous attach evidence if exist
                $file = $request->file('attach_evidence');
                $path = '/uploads/user/attach_evidence/';
                $mrecord->attach_evidence = HelperFunctions::saveFile($path,$file);
            }
            $mrecord->save();
            return back()->with("Success","Data Save Successfully");
                // return  view('dashboard.form_records.maintance_record',compact('mrecord'));

        // }catch(Exception $exc){
        //     print_r($exc->getMessage());
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Maintain_rec  $maintain_rec
     * @return \Illuminate\Http\Response
     */
    public function show(Maintain_rec $maintain_rec)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Maintain_rec  $maintain_rec
     * @return \Illuminate\Http\Response
     */
    public function edit(Maintain_rec $maintain_rec)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Maintain_rec  $maintain_rec
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id=$request->id;
        $any_issues = $request->input('any_issues');
        if($any_issues==NULL){
            $any_issues="";
        }
        $mrecord= Maintain_rec::find($id);
            // $mrecord->mid=$request->input('mid');
      if(Auth::check() && Auth::user()->role_type == "admin"){
            $the_id = intval($request->input('user_id'));
       }else{
           $the_id = Auth()->user()->id;
       }  //dd( $the_id );
            $mrecord->user_id= $the_id;
            $mrecord->mrdate=$request->input('mrdate');
            $mrecord->mritem=$request->input('mritem');
            $mrecord->mractivity=$request->input('mractivity');
            $mrecord->mlocation=$request->input('mlocation');
            $mrecord->mrobservation=$request->input('mrobservation');
            $mrecord->mractions=$request->input('mractions');
            $mrecord->mractivityperofrmby=$request->input('mractivityperofrmby');
            $mrecord->any_issues=$any_issues;
            //Check if user attach evidence
            if ($request->file('attach_evidence') && Schema::hasColumn('tbl_maintain_recs','attach_evidence')) {
                //Delete previous attach evidence if exist
                if (File::exists(public_path($mrecord->attach_evidence))) {
                    File::delete(public_path($mrecord->attach_evidence));
                }

                $file = $request->file('attach_evidence');
                $path = '/uploads/user/attach_evidence/';
                $mrecord->attach_evidence = HelperFunctions::saveFile($path,$file);
            }

            $mrecord->save();
            return back()->with("Success","Data Save Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Maintain_rec  $maintain_rec
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $maintain = Maintain_rec::find($request->id);
        if (File::exists(public_path($maintain->attach_evidence))) {
            File::delete(public_path($maintain->attach_evidence));
        }
        $maintain->delete();
        return back()->with("Success","Deleted");
    }
}
