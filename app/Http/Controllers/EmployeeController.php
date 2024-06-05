<?php

namespace App\Http\Controllers;

use App\Helpers\HelperFunctions;
use App\Employee;
use App\EmployeeTraning;
use App\EmpSkills;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Certificate;
use App\CertificateOption;
use Notification;
use App\Notifications\NotifyEmployee;

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

            //  $empcertificates=Employee::join('wp_users','wp_users.user_email','=','tbl_employees.email')
            //  ->orderBy('tbl_employees.id','DESC')->get();

             $users = Employee::where('user_id',$userid)->orderBy('id','DESC')->get();
             //dd($users);
             $wp_users = [];
             foreach($users as $user){
                $wp_users[] = Certificate::where('user_email', $user->email)->get();
             }
            //  foreach($wp_users as $wp_user){
            //     foreach($wp_user as $user){
            //     $uid= '"user_id";i:'.$user->ID.';';
            //     $options = CertificateOption::where('option_name', 'LIKE', "%user_cert_%")->and('option_value', 'LIKE', "%".$uid."%")->get();
            //     }
            // }

        return view('dashboard.form_records.employess',compact('userinfo','employess','emptraining', 'wp_users'));

        //return view('dashboard.form_records.employess',compact('userinfo','employess','emptraining'));

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
       EmpSkills::where('skill_id',$request->employskillid)->update([
             'empskill'=>$request->editempskill,
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
        // dd($request->all()); 
        $employee= new Employee();
        if(isset($request->is_admin) && $request->is_admin=="admin")
        {
            $user_id=$request->user_id;
        }
        else
        {
            $user_id=Auth()->user()->id;
        }

        $result = Employee::where("user_id",$user_id)
            ->where("empNumber",$request->empNumber)
            ->exists();
        if ($result == true){
            return back()->with("Error","Record was not saved. The Employee ID Number already exists!");
        }

        $employee->user_id= $user_id;
        $employee->systemid=123;
        $employee->surname=$request->input('surname');
        $employee->first_name=$request->input('first_name');
        $employee->email=$request->input('email');
        $employee->empNumber=$request->input('empNumber');
        $employee->startDate=$request->input('startDate');
        $employee->jobdetails=$request->input('jobdetails');

        if ($request->file('employee_cv')) {
            $file = $request->file('employee_cv');
            $path = '/uploads/user/employee_cv/';
            $employee->cv = HelperFunctions::saveFile($path,$file);
        }

        $employee->save();

        Notification::route("mail", $request->email)->notify(new NotifyEmployee());
        return back();
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

        $result = Employee::where("user_id",$user_id)
            ->where("empNumber",$request->empNumber)
            ->where("id",'<>',$id)
            ->exists();
        if ($result == true){
            return back()->with("Error","Record was not saved. The Employee ID Number already exists!");
        }
        $employee->user_id=$user_id;
        $employee->systemid=$request->input('systemid');
        $employee->surname=$request->input('surname');
        $employee->first_name=$request->input('first_name');
        $employee->empNumber=$request->input('empNumber');
        $employee->startDate=$request->input('startDate');
        $employee->jobdetails=$request->input('jobdetails');

        //Check if user uploaded cv
        if ($request->file('employee_cv')) {
            //Delete previous cv if exist
            if (File::exists(public_path($employee->cv))) {
                File::delete(public_path($employee->cv));
            }

            $file = $request->file('employee_cv');
            $path = '/uploads/user/employee_cv/';
            $employee->cv = HelperFunctions::saveFile($path,$file);
        }

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
            $employee = Employee::find($request->id);
            if (File::exists(public_path($employee->cv))) {
                File::delete(public_path($employee->cv));
            }
            EmpSkills::where('empid',$request->id)->delete();
            EmployeeTraning::where('empid',$request->id)->delete();
            $employee->delete();
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
