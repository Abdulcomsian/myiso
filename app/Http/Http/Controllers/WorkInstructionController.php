<?php

namespace App\Http\Controllers;

use App\Workinstructions;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkInstructionController extends Controller
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
        $work=Workinstructions::where('user_id',$userid)->get();
        $employess=Workinstructions::join('tbl_employees','tbl_employees.systemid','=','tbl_workinstruction.empId')->where('tbl_employees.user_id',$userid)->get();
        return view('dashboard.form_records.work_instruction',compact('work','employess'));
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
            'workinstruction'=>'required',
        ]);
        try{
            $workinst= new Workinstructions();
            $workinst->user_id=Auth()->user()->id;
             $workinst->workinstruction=$request->input('workinstruction');
             $workinst->instructionref=$request->input('instructionref');
             $workinst->empId=$request->input('empId');
             $workinst->issueDate=$request->input('issueDate');
             $workinst->scop=$request->input('scop');
             $workinst->point1=$request->input('point1');
             $workinst->point2=$request->input('point2');
             $workinst->point3=$request->input('point3');
             $workinst->point4=$request->input('point4');
             $workinst->point5=$request->input('point5');
             $workinst->point6=$request->input('point6');
             $workinst->point7=$request->input('point7');
             $workinst->point8=$request->input('point8');
             $workinst->point9=$request->input('point9');
             $workinst->point10=$request->input('point10');
             $workinst->point11=$request->input('point11');
             $workinst->point12=$request->input('point12');
             $workinst->save();
             //  Toastr->success('Have fun storming the castle!', 'Miracle Max Says');
              return redirect('/work_instruction')->with("Success","Data Save Successfully");
         }catch(Exception $exc){
             return redirect('/work_instruction')->with("Error","Error");
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
        $workinst=Workinstructions::find($id);
        $workinst->user_id=Auth()->user()->id;
         $workinst->workinstruction=$request->input('workinstruction');
         $workinst->instructionref=$request->input('instructionref');
         $workinst->empId=$request->input('empId');
         $workinst->issueDate=$request->input('issueDate');
         $workinst->scop=$request->input('scop');
         $workinst->point1=$request->input('point1');
         $workinst->point2=$request->input('point2');
         $workinst->point3=$request->input('point3');
         $workinst->point4=$request->input('point4');
         $workinst->point5=$request->input('point5');
         $workinst->point6=$request->input('point6');
         $workinst->point7=$request->input('point7');
         $workinst->point8=$request->input('point8');
         $workinst->point9=$request->input('point9');
         $workinst->point10=$request->input('point10');
         $workinst->point11=$request->input('point11');
         $workinst->point12=$request->input('point12');
         $workinst->save();
         //  Toastr->success('Have fun storming the castle!', 'Miracle Max Says');
          return redirect('/work_instruction')->with("Success","Data Save Successfully");
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
        $req=Workinstructions::find($id)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];
        return redirect('/work_instruction')->with($notification);

    }
}
