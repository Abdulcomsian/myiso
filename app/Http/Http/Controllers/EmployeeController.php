<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EmployeeTraning;
use App\EmpSkills;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $userinfo=Employee::where('user_id',$userid)->get();
        $employess=Employee::join('tbl_employees_skills','tbl_employees_skills.empid','=','tbl_employees.id')->  where('tbl_employees.user_id',$userid)->get();
        $emptraining=Employee::join('tbl_employees_traning','tbl_employees_traning.empid','=','tbl_employees.id')->  where('tbl_employees.user_id',$userid)->get();
        return view('dashboard.form_records.employess',compact('userinfo','employess','emptraining'));

    }
    public function empSkills(Request $request){
         // print_r($request->all());
         $this->validate($request,[
            'empid'=>'required',
        ]);
        try{
            $customer= new EmpSkills();
            $customer->user_id=Auth()->user()->id;
             $customer->empid=$request->input('empid');
             $customer->empskill=$request->input('empskill');
             $customer->save();

            //  print_r($customer->all());
             //  Toastr->success('Have fun storming the castle!', 'Miracle Max Says');
              return redirect('/employess')->with("Success","Data Save Successfully");
         }catch(Exception $exc){
            //  return redirect('/employess')->with("Error","Error");
            print_r($exc->getMessage());
         }

    }
    public function empTraining(Request $request){
            // print_r($request->all());
            $this->validate($request,[
                'empid'=>'required',
            ]);
            try{
                $employee= new EmployeeTraning();
                $employee->user_id=Auth()->user()->id;
                $employee->empid=$request->input('empid');
                $employee->traningdate=$request->input('traningdate');
                $employee->traningdetails=$request->input('traningdetails');
                $employee->save();
                return redirect('/employess')->with("Success","Data Save Successfully");
            }catch(Exception $exception){
                return redirect('/employess')->with("Error","Err");

            }
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

        try{
            $employee= new Employee();
            $employee->user_id=Auth()->user()->id;
            $employee->systemid=123;
            $employee->surname=$request->input('surname');
            $employee->first_name=$request->input('first_name');
            $employee->empNumber=$request->input('empNumber');
            $employee->startDate=$request->input('startDate');
            $employee->jobdetails=$request->input('jobdetails');
            $employee->save();
            return redirect('/employess')->with("Success","Data Save Successfully");
        }catch(Exception $exception){
            return redirect('/employess')->with("Error","Err");

        }


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
        $employee->user_id=Auth()->user()->id;
        $employee->systemid=$request->input('systemid');
        $employee->surname=$request->input('surname');
        $employee->first_name=$request->input('first_name');
        $employee->empNumber=$request->input('empNumber');
        $employee->startDate=$request->input('startDate');
        $employee->jobdetails=$request->input('jobdetails');
        $employee->save();
        return redirect('/employess')->with("Success","Data Save Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
