<?php

namespace App\Http\Controllers;

use App\Interested;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Request;

class interestedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $userid=Auth::user()->id;
       
        $interested=Interested::where('user_id',$userid)->get();
        return view('dashboard.form_records.interested_parties',compact('interested'));
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
            'interestedparty'=>'required',
            'needs'=>'required',
        ]);
        // try{
             $Interested= new Interested;
             if(Auth::check() && Auth::user()->role_type == "admin"){
             $the_id = $request->input('user_id');
            // echo 'is admin';
            // exit;
        }else{
            $the_id = Auth()->user()->id;
        }
        // echo $the_id;exit;
             $Interested->interested_party=$request->input('interestedparty');
             $Interested->needs=$request->input('needs');
             $Interested->user_id=$the_id;

              $Interested->save();

             return back()->with("Success","Data Save Successfully");
        // }catch(Exception $exc){
        //     print_r($exc->getMessage());
        // }
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
            if(Auth::check() && Auth::user()->role_type == "admin"){
            $the_id = intval($request->input('user_id'));
       }else{
           $the_id = Auth()->user()->id;
       }   
       
        $id=$request->id;
        // try{
            $Interested=Interested::find($id);
            
            $Interested->user_id=$the_id;
            
            $Interested->interested_party=$request->input('interestedparty');
            $Interested->needs=$request->input('needs');
            $Interested->save();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {

        $id=$req->id;
        $req=Interested::find($id)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return back()->with($notification);

    }
}
