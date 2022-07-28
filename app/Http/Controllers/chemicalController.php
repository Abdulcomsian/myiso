<?php

namespace App\Http\Controllers;


use App\Interested;
use App\Chemical;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Request;

class chemicalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $userid=Auth::user()->id;
        $chemical=Chemical::where('user_id',$userid)->orderBy('id','DESC')->get();
        
        return view('dashboard.form_records.chemical_control',compact('chemical'));
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
            'chemicalname'=>'required',
        ]);
        try{
             $Chemical= new Chemical;
             $is_admin = $request->input('is_admin');
             if($is_admin=="admin"){
                    $Chemical->user_id = $request->input('user_id');
             }else{
                     $Chemical->user_id=Auth()->user()->id;    
               }
             $Chemical->chemical_name=$request->input('chemicalname');
             $Chemical->chemical_desc=$request->input('chemical_desc');
             $Chemical->chemical_type=$request->input('chemical_type');
             $Chemical->location_used=$request->input('location');
             $Chemical->activity_hazard=$request->input('activity_hazard');
             $Chemical->identified_hazard=$request->input('identified_hazard');
             $Chemical->identified_chazard=$request->input('identified_chazard');
             $Chemical->target_hazard=$request->input('target_organs');
             $Chemical->who_risk=$request->input('who_risk');
             $Chemical->protection_required=$request->input('protection_required');
             
             
             $Chemical->still_used=$request->input('still_used');
              $Chemical->save();
              if($is_admin=="admin"){
                    return back();
             }else{
                      return redirect('/chemical_control')->with("Success","Data Save Successfully");   
               }
           
        }catch(Exception $exc){
            print_r($exc->getMessage());
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
        try{
            $Chemical=Chemical::find($id);
            $Chemical->chemical_name=$request->input('chemical_name');
            $Chemical->chemical_desc	=$request->input('chemical_desc');
            $Chemical->chemical_type=$request->input('chemical_type');
            $Chemical->location_used=$request->input('location');
            $Chemical->activity_hazard=$request->input('activity_hazard');
            $Chemical->identified_chazard=$request->input('identified_chazard');
            $Chemical->identified_hazard=$request->input('identified_hazard');
            $Chemical->target_hazard=$request->input('target_hazard');
            $Chemical->who_risk=$request->input('who_risk');
            $Chemical->protection_required=$request->input('protection_required');
            $Chemical->still_used=$request->input('still_used');
            
            $Chemical->save();
             $notification = [
                'message' => 'Record  updated successfully.!',
                'alert-type' => 'success'
            ];
             return back();
        }catch(Exception $exc){
            print_r($exc->getMessage());
        }
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

        return redirect('/interesting_parties')->with($notification);

    }
    
    public function destroy_chemical(Request $request)
    {
         Chemical::find($request->id)->delete();
         $notification = [
                'message' => 'Record  Deleted successfully.!',
                'alert-type' => 'success'
            ];
        return redirect('/chemical_control')->with($notification);
    }
}
