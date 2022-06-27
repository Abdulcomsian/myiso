<?php

namespace App\Http\Controllers;

use App\Mgtreview;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MgtreviewController extends Controller
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
        $userData=Mgtreview::where('user_id',$userid)->orderBy('id','DESC')->get();
        return  view('dashboard.form_records.managment_reviews',compact('userData'));

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
        // dd($request->all());
      $this->validate($request,[
          'mgtreviewId'=>'required',

      ]);
      try{
            $mgtRev= new Mgtreview();
            $is_admin = $request->input('is_admin');
             if($is_admin=="admin"){
                $mgtRev->user_id = $request->input('user_id');
           }else{
                $mgtRev->user_id=Auth()->user()->id;    
           }
            // $mgtRev->user_id=Auth::user()->id;
            $mgtRev->mgtreviewId=$request->input('mgtreviewId');
            $mgtRev->reviewdate=$request->input('reviewdate');
            $mgtRev->meetingatt=$request->input('meetingatt');
            $mgtRev->prevmeeting=$request->input('prevmeeting');
            $mgtRev->recommendedchange=$request->input('recommendedchange');
            $mgtRev->prevobjectv=$request->input('prevobjectv');
            $mgtRev->sammarisecustomr=$request->input('sammarisecustomr');
            $mgtRev->conformity=$request->input('conformity');
            $mgtRev->nonconformities=$request->input('nonconformities');
            $mgtRev->monitoringres=$request->input('monitoringres');
            $mgtRev->auditres=$request->input('auditres');
            $mgtRev->externalprovider=$request->input('externalprovider');
            $mgtRev->adequacy=$request->input('adequacy');

            $mgtRev->effectiveness=$request->input('effectiveness');
            $mgtRev->newquality=$request->input('newquality');
            $mgtRev->save();
            // if(Auth()->user()->role_type=="admin"){
            //     return back()->with($notification);
            // }else{
            //     return back()->with($notification);
            // }
            return back();
            //return redirect('/add_management_review')->with("Success","Data Save Successfully");

      }catch(Exception $exc){
          print_r($exc->getMessage());
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mgtreview  $mgtreview
     * @return \Illuminate\Http\Response
     */
    public function show(Mgtreview $mgtreview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mgtreview  $mgtreview
     * @return \Illuminate\Http\Response
     */
    public function edit(Mgtreview $mgtreview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mgtreview  $mgtreview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id=$request->id;
        $mgtRev=Mgtreview::find($id);
        $is_admin = $request->input('is_admin');
             if($is_admin=="admin"){
                $mgtRev->user_id = $request->input('user_id');
           }else{
                $mgtRev->user_id=Auth()->user()->id;    
           }
        // $mgtRev->user_id=Auth::user()->id;
        $mgtRev->mgtreviewId=$request->input('mgtreviewId');
        $mgtRev->reviewdate=$request->input('reviewdate');
        $mgtRev->meetingatt=$request->input('meetingatt');
        $mgtRev->prevmeeting=$request->input('prevmeeting');
        $mgtRev->recommendedchange=$request->input('recommendedchange');
        $mgtRev->prevobjectv=$request->input('prevobjectv');
        $mgtRev->sammarisecustomr=$request->input('sammarisecustomr');
        $mgtRev->conformity=$request->input('conformity');
        $mgtRev->nonconformities=$request->input('nonconformities');
        $mgtRev->monitoringres=$request->input('monitoringres');
        $mgtRev->auditres=$request->input('auditres');
        $mgtRev->externalprovider=$request->input('externalprovider');
        $mgtRev->adequacy=$request->input('adequacy');

        $mgtRev->effectiveness=$request->input('effectiveness');
        $mgtRev->newquality=$request->input('newquality');
        $mgtRev->save();
        return back();
        // return redirect('/add_management_review')->with("Success","Data Save Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mgtreview  $mgtreview
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {

        $id=$req->id;
        $req=Mgtreview::find($id)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];
        return redirect('/add_management_review')->with($notification);

    }
}
