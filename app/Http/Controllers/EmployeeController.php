<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EmployeeTraning;
use App\EmpSkills;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
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
        $userinfo=Employee::where('user_id',$userid)->orderBy('id','DESC')->get();
        // $employess=Employee::join('tbl_employees_skills','tbl_employees_skills.empid','=','tbl_employees.id')->where('tbl_employees.user_id',$userid)->get();
        // $e = EmpSkills::with('employee')->get();
        $employess = DB::table('tbl_employees_skills')
            ->select('tbl_employees_skills.skill_id as skill_id',
            'tbl_employees_skills.empskill as empskill',
            'tbl_employees.empNumber as empNumber',
            'tbl_employees.surname as surname',
            'tbl_employees.first_name as first_name'
            )
            ->join('tbl_employees','tbl_employees_skills.empid','=','tbl_employees.id')
            ->where('tbl_employees_skills.user_id','=',$userid)
            ->orderBy('tbl_employees_skills.created_at','DESC')
            ->get();
        $emptraining=Employee::join('tbl_employees_traning','tbl_employees_traning.empid','=','tbl_employees.id')
            ->where('tbl_employees.user_id',$userid)->orderBy('tbl_employees_traning.created_at','DESC')->get();

        return view('dashboard.form_records.employess',compact('userinfo','employess','emptraining'));

    }
    public function empSkills(Request $request){
        try{
            $customer= new EmpSkills();
            // dd($customer);
            if(isset($request->is_admin) && $request->is_admin=="admin")
            {
                $user_id=$request->user_id;
            }
            else
            {
                $user_id=Auth()->user()->id;
            }

             $customer->user_id=$user_id;
             $customer->empid=intval($request->input('empid'));
             $customer->empskill=$request->input('empskill');
            //  dd($customer);
             $customer->save();
              return back()->with("Success","Data Save Successfully");
         }catch(Exception $exc){
            //  return redirect('/employess')->with("Error","Error");
            print_r($exc->getMessage());
         }

    }
    public function empTraining(Request $request){

            try{
                $employee= new EmployeeTraning();
                 if(isset($request->is_admin) && $request->is_admin=="admin")
                {
                    $user_id=$request->user_id;
                }
                else
                {
                    $user_id=Auth()->user()->id;
                }
                $employee->user_id=$user_id;
                $employee->empid=$request->input('empid');
                $employee->traningdate=$request->input('traningdate');
                $employee->traningdetails=$request->input('traningdetails');
                
                $employee->save();
                return back()->with("Success","Data Save Successfully");
            }catch(Exception $exception){
                return back()->with("Error","Err");

            }
    }

    //update employee skills
    public function updateempSkills(Request $request)
    {
//       dd($request->all());
       EmpSkills::where('skill_id',$request->employskillid)->update([
             'empskill'=>$request->editempskill,
//             'empid'=>$request->editempid,
           ]);
       return back();
    }

    //update employ training
    public function updateemptraining(Request $request)
    {
        EmployeeTraning::where('traning_id',$request->edittrainid)->update([
//              'empid'=>$request->editempidt,
              'traningdate'=>$request->edittraningdate,
              'traningdetails'=>$request->edittraningdetails
            ]);
            return back();
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
        //  try{
            $employee= new Employee();
            if(isset($request->is_admin) && $request->is_admin=="admin")
            {
                $user_id=$request->user_id;
            }
            else
            {
                $user_id=Auth()->user()->id;
            }
            $employee->user_id= $user_id;
            $employee->systemid=123;
            $employee->surname=$request->input('surname');
            $employee->first_name=$request->input('first_name');
            $employee->empNumber=$request->input('empNumber');
            $employee->startDate=$request->input('startDate');
            $employee->jobdetails=$request->input('jobdetails');
            $employee->save();
            return back();
        // }catch(Exception $exception){
        //     return back()->with("Error","Err");

        // }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id=$request->id;
        $employee=Employee::find($id);
        if(isset($request->is_admin) && $request->is_admin=="admin")
        {
            $user_id=$request->user_id;
        }
        else
        {
            $user_id=Auth()->user()->id;
        }
        $employee->user_id=$user_id;
        $employee->systemid=$request->input('systemid');
        $employee->surname=$request->input('surname');
        $employee->first_name=$request->input('first_name');
        $employee->empNumber=$request->input('empNumber');
        $employee->startDate=$request->input('startDate');
        $employee->jobdetails=$request->input('jobdetails');
        $employee->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $type=$request->type;
        if($type=="employee")
        {
         Employee::find($request->id)->delete();

        }
        if($type=="employeeskill")
        {
            EmpSkills::where('skill_id',$request->id)->delete();
        }
        if($type=="employeetraining")
        {
            EmployeeTraning::where('traning_id',$request->id)->delete();
        }
         return back();
    }
}
