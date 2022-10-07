<?php

namespace App\Http\Controllers;

use App\AccidentRisk;
use App\AddUsers;
use App\Assessment;
use App\Audit;
use App\calibration;
use App\customer_review;
use App\customers;
use App\Employee;
use App\EmployeeTraning;
use App\EmpSkills;
use App\Helpers\HelperFunctions;
use App\Maintain_rec;
use App\Mgtreview;
use App\Nonconform;
use App\Qmsaudit;
use App\requirement;
use App\SendNotifications;
use App\Supplier;
use App\Workinstructions;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Chemical;
use Illuminate\Support\Facades\Schema;

class AddUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = AddUsers::where('role_type', 'user')->orderBy('id', 'desc')->get();
        return view('admin.dashboard.admin.view_user', compact('users'));
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

        try {
            //currdisabl
            $this->validate($request, [
                'name' => 'required',
                'password' => 'required',
                'email' => 'required'

            ]);
            $pass = $request->input('password');
            $addusers = new AddUsers();
            if ($request->file('user_image')) {
                $imagePath = $request->file('user_image');
                $imageName = uniqid() . "." . $request->file('user_image')->extension();

                $path = $request->file('user_image')->storeAs('/uploads/user', $imageName, 'public');
                $request->file('user_image')->move(public_path('/uploads/user'), $imageName);

                $addusers->profile_image = $path;

            }
            $addusers->persone_iso = $request->input('person_iso');
            $addusers->contact_number_iso = $request->input('contact_iso');
            $addusers->emailaddress_iso = $request->input('email_iso');

            /*$this->validate($request, [
                'iso9001_certificate' => 'required',
                'filenames.*' => 'mimes:.pdf'
            ]);
            $this->validate($request, [
                'iso14001_certificate' => 'required',
                'filenames.*' => 'mimes:.pdf'
            ]);
            $this->validate($request, [
                'iso45001_certificate' => 'required',
                'filenames.*' => 'mimes:.pdf'
            ]);*/


            if ($request->file('iso9001_certificate')) {

                $file_path = $request->file('iso9001_certificate');
                $file_name = uniqid() . "." . $request->file('iso9001_certificate')->extension();

                $path = $request->file('iso9001_certificate')->storeAs('/uploads/user', $file_name, 'public');
                $request->file('iso9001_certificate')->move(public_path('/uploads/user'), $file_name);
                $addusers->iso9001_certificate = $path;

                $addusers->iso9001_expirydate = $request->input('iso9001_expirydate');

                $addusers->iso9001_description = $request->input('iso9001_description');
            }

            if ($request->file('iso14001_certificate')) {

                $iso14001_certificate_path = $request->file('iso14001_certificate');
                $iso14001_certificate_name = uniqid() . "." . $request->file('iso14001_certificate')->extension();

                $iso14001_certificate_path = $request->file('iso14001_certificate')->storeAs('/uploads/user', $iso14001_certificate_name, 'public');
                $request->file('iso14001_certificate')->move(public_path('/uploads/user'), $iso14001_certificate_name);
                $addusers->iso14001_certificate = $iso14001_certificate_path;


                $addusers->iso14001_expirydate = $request->input('iso14001_expirydate');

                $addusers->iso14001_description = $request->input('iso14001_description');
            }

            if ($request->file('iso45001_certificate')) {

                $iso45001_certificate_path = $request->file('iso45001_certificate');
                $iso45001_certificate_name = uniqid() . "." . $request->file('iso45001_certificate')->extension();

                $iso45001_certificate_path = $request->file('iso45001_certificate')->storeAs('/uploads/user', $iso45001_certificate_name, 'public');
                $request->file('iso45001_certificate')->move(public_path('/uploads/user'), $iso45001_certificate_name);
                $addusers->iso45001_certificate = $iso45001_certificate_path;


                $addusers->iso45001_expirydate = $request->input('iso45001_expirydate');

                $addusers->iso45001_description = $request->input('iso45001_description');
            }
            if (Schema::hasColumns('users', ['audit_report'])) {
                if ($request->file('audit_report')) {

                    $audit_report_path = $request->file('audit_report');
                    $audit_report_name = uniqid() . "." . $request->file('audit_report')->extension();

                    $audit_report_path = $request->file('audit_report')->storeAs('/uploads/user/audit_report', $audit_report_name, 'public');
                    $request->file('audit_report')->move(public_path('/uploads/user/audit_report'), $audit_report_name);
                    $addusers->audit_report = $audit_report_path;
                }
            }
             $addusers->audit_comment=$request->input('audit_comment');

            //$addusers->expiry_date=$request->input('expiry_date');
            $addusers->country = $request->input('country');


            $addusers->name = $request->input('name');
            $addusers->email = $request->input('email');
            $addusers->password = Hash::make($pass);
            $addusers->phone = $request->input('phone');
            $addusers->phonecode = $request->input('phonecode');
            if ($request->input('phoneflag') == "preferred") {
                $phoneflag = "us";
            } else {
                $phoneflag = $request->input('phoneflag');
            }
            // echo $phoneflag;exit;
            $addusers->phoneflag = $phoneflag;
            // $addusers->phoneflag=$request->input('phoneflag');
            $addusers->iso_phone_code = $request->input('isophonecode');
            if ($request->input('isophoneflag') == "preferred") {
                $isophoneflag = "us";
            } else {
                $isophoneflag = $request->input('isophoneflag');
            }
            // echo $phoneflag;exit;
            $addusers->iso_phone_flag = $isophoneflag;
            // $addusers->iso_phone_flag=$request->input('isophoneflag');
            $addusers->director = $request->input('director');
            $addusers->sales_process = $request->input('sales_process');
            //    $addusers->company_profile=$request->input('company_profile');
            if ($request->file('company_profile')) {
                $imagePath = $request->file('company_profile');
                $imageName = uniqid() . "." . $request->file('company_profile')->extension();

                $path = $request->file('company_profile')->storeAs('/uploads/user', $imageName, 'public');
                $request->file('company_profile')->move(public_path('/uploads/user'), $imageName);

                $addusers->company_profile = $path;

            }

            $addusers->company_name = $request->input('company_name');
            $addusers->company_address = $request->input('company_address');
            $addusers->role_type = 'user';
            $addusers->purchasing_process = $request->input('purchasing_process');
            $addusers->servicing_process = $request->input('servicing_process');
            $addusers->competency_process = $request->input('competency_process');
            $addusers->scope = $request->input('scope');
            $addusers->order_number = $request->input('order_number');
            $addusers->Company_overview = $request->input('Company_overview');
            $current = Carbon::now();
            $expiry = $current->addYears(3);
            $addusers->expiry_date = $expiry;

            $addusers->save();
            return redirect('/add_user')->with("Success", "User added Successfully.");
        } catch (Exception $exc) {
            return redirect('/add_user')->with("Error", "Error saving data, please try again.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AddUsers  $addUsers
     * @return \Illuminate\Http\Response
     */
    public function show(AddUsers $addUsers)
    {
        //
    }
    public function userDetails($request)
    {
        $userid=$request;
        return view('admin.dashboard.admin.edit_user',compact('userid'));

    }
    public function requirementcheck($request)
    {
        $getReq=requirement::where('user_id',$request)->orderBy('id','DESC')->get();


        return view('admin.adminform_records.requirements_aspect',compact('getReq'));

    }

    public function ProcessCheck($request)
    {
        $getprocess=Audit::where('user_id',$request)->orderBy('id','DESC')->get();


        return view('admin.adminform_records.process_audit',compact('getprocess'));

    }
    /*Delete notifications*/
    public function deleteNotifications(Request $request)
    {
        $id=$request->id;
        DB::table('users_messages')->where('id', $id)->update(['admin_delete' => 1]);
        toastSuccess('Notification message deleted successfully!');
        return back();
    }

    /*Delete Message*/
    public function deleteMessage(Request $request)
    {
        $id=$request->id;
        DB::table('send_notification')->where('id', $id)->update(['admin_delete' => 1]);
        return back();
    }

    public function send_notifications()
    {
        // $getprocess=Audit::where('user_id',$request)->get();
        $users=AddUsers::where('role_type','user')->get();
        $adminmessage=SendNotifications::join('users','users.id','=','send_notification.send_to')
            ->select('send_notification.id as notification_id','send_notification.created_at as notification_created_at','send_notification.*','users.*')
            ->where('admin_delete',false)
            ->orderby('notification_id','desc')
            ->get();
        return view('admin.dashboard.admin.send_notifications',compact('users','adminmessage'));

    }  
    
    public function send_message(Request $request)
    {
        // $getprocess=Audit::where('user_id',$request)->get();
        if($request->ajax())
        {
            //  dd($request->start_date);
             
             //&& $request->month
            if($request->type=="month")
            {
                $start_date = date("Y-m-d", strtotime($request->start_date));
                $end_date = date("Y-m-d", strtotime($request->end_date));
                //$end_date = date("YYYY-mm-dd",$request->end_date);
                // dd($start_date);..
                if(isset($request->filter_by_certificate)){
                    if($request->filter_by_certificate=="iso9001_certificate"){
                        $users=AddUsers::where([["last_login",">=", $start_date],["last_login","<=", $end_date], ["iso9001_certificate","!=", '']])->get();
                    }else if($request->filter_by_certificate=="iso14001_certificate"){
                        $users=AddUsers::where([["last_login",">=", $start_date],["last_login","<=", $end_date], ["iso14001_certificate","!=", '']])->get();
                    }else if($request->filter_by_certificate=="iso45001_certificate"){
                        $users=AddUsers::where([["last_login",">=", $start_date],["last_login","<=", $end_date]])->get();
                        //["iso45001_certificate","!=", '']
                    }
                    // if(isset($request->start_date) && isset($request->end_date)){
                    //     dd("here");
                    // }else if(isset($request->start_date) && $request->end_date==NULL){
                    //     dd("start date only");
                    // }else if(isset($request->end_date) && $request->start_date==NULL){
                    //     dd("end date only");
                    // }else{
                    //     dd("no date selected");
                    // }
                    // dd($users);
                }else{
                    dd("Please select Certification");
                }
                // $users=AddUsers::where("last_login",">", Carbon::now()->subMonths($request->month))->get();

                
            }
            elseif($request->type="certificate" && $request->cert){
                //  dd($request->cert);
                if($request->cert=="iso9001_certificate"){
                    $users=AddUsers::where("iso9001_certificate","!=",'')->whereNull('iso14001_certificate')->whereNull('iso45001_certificate')->get(); 
                }else if($request->cert=="iso14001_certificate"){
                    $users=AddUsers::where("iso14001_certificate","!=",'')->whereNull('iso9001_certificate')->whereNull('iso45001_certificate')->get(); 
                }else if($request->cert=="iso45001_certificate"){
                    $users=AddUsers::where("iso45001_certificate","!=",'')->whereNull('iso9001_certificate')->whereNull('iso14001_certificate')->get(); 
                }
                else if($request->cert=="all"){
                    // $users=AddUsers::where("iso9001_certificate","!=",'')->where("iso14001_certificate","!=","")->where("iso45001_certificate","!=","")->get();
                    $users=AddUsers::whereNotNull("iso9001_certificate")->orWhereNotNull("iso14001_certificate")->orWhereNotNull("iso45001_certificate")->where('id', '!=', 1)->get();

                }else if($request->cert=="ims"){
                    $users=AddUsers::where([["iso9001_certificate","!=", ''], ["iso14001_certificate","!=", ''], ["iso45001_certificate","!=", '']])->get();
                    // $users=AddUsers::where("iso9001_certificate","!=",'')->where("iso14001_certificate","!=","")->where("iso45001_certificate","!=","")->get();
                }
                else{
                    $users=AddUsers::where("".$request->cert."","!=","")->get();
                }
                
            }
            else{
              //  $users=AddUsers::where('role_type','user')->get();
                $users='';
            }
           
            if(isset($users))
            {
                $list='';
                $option='';
                $i=1;
                foreach($users as $us)
                {
                    $option.='<option value="'.$us->id.'">'.$us->name.'</option>';
                    $list.='<li class=""><label for=ms-opt-'.$i.'" style="padding-left: 23px;"><input type="checkbox" value='.$us->id.' title='.$us->name.' id="ms-opt-'.$i.'"/>'.$us->name.'</label></li>';
                    $i++;
                }
                echo json_encode(array($list,$option));
            }else{
                echo"error";
            }
            
        }
        else{
            $users=AddUsers::where('role_type','user')->get();
            $adminmessage=SendNotifications::join('users','users.id','=','send_notification.send_to')
            ->select('send_notification.id as notification_id','send_notification.*','users.*')
            ->where('admin_delete',false)
            ->orderby('notification_id','desc')
            ->get();
            return view('admin.dashboard.admin.send_message',compact('users','adminmessage'));
        }
        

    }



    public function addreq(Request $request){
        //   dd($request->all());
        $addreq= new requirement;
        $addreq->user_id=$request->user_id;
        $addreq->requirment_title=$request->requirement;
        $addreq->completion_date=$request->req_date;
        $addreq->periods=$request->period;
        $createdAt = Carbon::parse($request->req_date)->addMonth($request->period);
         $addreq->due_date=$createdAt;


         $addreq->save();
        return redirect()->back();
    }

    public function sendNotifications(Request $request){
        $users = $request->userid;
        $data = [];

        if ($request->file('attachment')) {
            $imagePath = $request->file('attachment');
            $imageName = uniqid() . "." . $request->file('attachment')->extension();
            $path = $request->file('attachment')->storeAs('uploads/user', $imageName, 'public');
            $request->file('attachment')->move(public_path('uploads/user'), $imageName);
            $data['attachement'] = $path;
        }

        $data['title']=$request->input('title');
        $data['message']=$request->input('message');
        $data['created_at'] = date('Y-m-d H:i:s');

        foreach ($users as $user){
            $data['send_to'] = $user;
            SendNotifications::create($data);
        }

        return redirect()->back();
    }

    public function AuditsCheck($request){
        $auditreport=Qmsaudit::where('user_id',$request)->orderBy('id','DESC')->get();
        return view('admin.adminform_records.qms_audit',compact('auditreport'));

    }
    public function nonConformCheck($request){
        // $noneConform=Nonconform::where('user_id',$request)->get();
        // return view('admin.adminform_records.non_conformities',compact('noneConform'));

            $noneConform=Nonconform::where('user_id',$request)->get();
        $customers = DB::table('tbl_customer')->where('user_id',$request)->get();

        $customers_nonconform = DB::table('tbl_noconformance')->join('tbl_customer','tbl_noconformance.customerID','tbl_customer.idNumber')
        ->select('tbl_noconformance.id as noid','tbl_noconformance.*','tbl_customer.*')
        ->where('tbl_noconformance.user_id',$request)->orderBy('tbl_noconformance.id','DESC')->get();
        return view('admin.adminform_records.non_conformities',compact('noneConform','customers','customers_nonconform'));

    }
    public function customerCheck($request){
        $customer=customers::where('user_id',$request)->orderBy('id','DESC')->get();
        return view('admin.adminform_records.customer',compact('customer'));

    }

    public function customerReviewad($request){
        $all_customers=customers::where('user_id',$request)->get();
        $customer_review=customer_review::where('user_id',$request)->orderBy('id','DESC')->get();

        return view('admin.adminform_records.customer_review',compact('customer_review','request','all_customers'));

    }
    public function supplierCheck($request){
        $supplier=Supplier::where('user_id',$request)->orderBy('id','DESC')->get();
        return view('admin.adminform_records.supplier',compact('supplier'));

    }
    public function calibrationcheck($request){
        $caliber=calibration::where('user_id',$request)->orderBy('id','DESC')->get();
        return view('admin.adminform_records.calibration_record',compact('caliber'));

    }
    public function EmployeCheck($request){

        $userinfo=Employee::with('user')->where('user_id',$request)->orderBy('id','DESC')->get();
       // $employess=Employee::join('tbl_employees_skills','tbl_employees_skills.empid','=','tbl_employees.id')->where('tbl_employees.user_id',$request)->get();
        // dd($employess);
        $employess = DB::table('tbl_employees_skills')
            ->select('tbl_employees_skills.skill_id as skill_id',
            'tbl_employees_skills.empskill as empskill',
            'tbl_employees.empNumber as empNumber',
            'tbl_employees.surname as surname',
            'tbl_employees.first_name as first_name',
            'users.email'
            )
            ->join('tbl_employees','tbl_employees_skills.empid','=','tbl_employees.id')
            ->join('users','users.id','=','tbl_employees.user_id')
            ->where('tbl_employees_skills.user_id','=',$request)
            ->orderBy('tbl_employees_skills.created_at','DESC')
            ->get();
      //  $emptraining=Employee::join('tbl_employees_traning','tbl_employees_traning.empid','=','tbl_employees.id')->  where('tbl_employees.user_id',$request)->get();

      $emptraining=Employee::join('tbl_employees_traning','tbl_employees_traning.empid','=','tbl_employees.id')
          ->where('tbl_employees.user_id',$request)
          ->orderBy('tbl_employees_traning.created_at','DESC')
          ->get();
      return view('admin.adminform_records.employess',compact('userinfo','employess','emptraining'));

    }
    public function managementCheck($request){

        $mgtrev=Mgtreview::where('user_id',$request)->orderBy('id','DESC')->get();
        return view('admin.adminform_records.managment_reviews',compact('mgtrev'));

    }
    public function maintainRecCheck($request){

        $mainrecord=Maintain_rec::where('user_id',$request)->orderBy('id','DESC')->get();
        return view('admin.adminform_records.maintance_record',compact('mainrecord'));

    }
    public function AccidentCheck($request){

        $riskassesment=AccidentRisk::where('user_id',$request)->orderBy('id','DESC')->get();
        return view('admin.adminform_records.accident_risk_assesment',compact('riskassesment'));

    }
    public function riskAssesmntCheck($request){
       $assessment=Assessment::where('user_id',$request)->orderBy('id','DESC')->get();
        return view('admin.adminform_records.risk_assessment',compact('assessment'));
    }
    public function workinstructionCheck($request){
        $work=Workinstructions::where('user_id',$request)->orderBy('id','DESC')->get();
        $employess = Employee::where('user_id',$request)->get();
        // $employess=Workinstructions::join('tbl_employees','tbl_employees.systemid','=','tbl_workinstruction.empId')->where('tbl_employees.user_id',$request)->get();
        return view('admin.adminform_records.work_instruction',compact('work','employess'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AddUsers  $addUsers
     * @return \Illuminate\Http\Response
     */
    public function edit(AddUsers $addUsers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AddUsers  $addUsers
     * @return \Illuminate\Http\Response
     */
      public function update(Request $request)
    {
        $id = $request->id;
        $user = AddUsers::find($id);
        if ($request->input('password') != '' || !empty($request->input('password'))) {
            $pass = $request->input('password');
            $user->password = Hash::make($pass);
        }
        if ($request->file('user_image')) {
            $imagePath = $request->file('user_image');
            $imageName = uniqid() . "." . $request->file('user_image')->extension();

            $path = $request->file('user_image')->storeAs('/uploads/user', $imageName, 'public');
            $request->file('user_image')->move(public_path('/uploads/user'), $imageName);
            $user->profile_image = $path;
        }
        $user->persone_iso = $request->input('person_iso');
        $user->contact_number_iso = $request->input('contact_iso');
        $user->emailaddress_iso = $request->input('email_iso');

        if ($request->file('iso9001_certificate')) {
            $file_path = $request->file('iso9001_certificate');
            $file_name = uniqid() . "." . $request->file('iso9001_certificate')->extension();

            $path = $request->file('iso9001_certificate')->storeAs('/uploads/user', $file_name, 'public');
            $request->file('iso9001_certificate')->move(public_path('/uploads/user'), $file_name);
            $user->iso9001_certificate = $path;
        }
        $user->iso9001_expirydate = $request->input('iso9001_expirydate');
        $user->iso9001_description = $request->input('iso9001_description');

        if ($request->file('iso14001_certificate')) {
            $iso14001_certificate_path = $request->file('iso14001_certificate');
            $iso14001_certificate_name = uniqid() . "." . $request->file('iso14001_certificate')->extension();

            $iso14001_certificate_path = $request->file('iso14001_certificate')->storeAs('/uploads/user', $iso14001_certificate_name, 'public');
            $request->file('iso14001_certificate')->move(public_path('/uploads/user'), $iso14001_certificate_name);
            $user->iso14001_certificate = $iso14001_certificate_path;

        }
        $user->iso14001_expirydate = $request->input('iso14001_expirydate');
        $user->iso14001_description = $request->input('iso14001_description');

        if ($request->file('iso45001_certificate')) {
            $iso45001_certificate_path = $request->file('iso45001_certificate');
            $iso45001_certificate_name = uniqid() . "." . $request->file('iso45001_certificate')->extension();

            $iso45001_certificate_path = $request->file('iso45001_certificate')->storeAs('/uploads/user', $iso45001_certificate_name, 'public');
            $request->file('iso45001_certificate')->move(public_path('/uploads/user'), $iso45001_certificate_name);
            $user->iso45001_certificate = $iso45001_certificate_path;

        }

        $user->iso45001_expirydate = $request->input('iso45001_expirydate');
        $user->iso45001_description = $request->input('iso45001_description');

        $user->country=$request->input('country');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        if ($request->input('phoneflag') == "preferred") {
            $phoneflag = "us";
        } else {
            $phoneflag = $request->input('phoneflag');
        }

        $user->phoneflag = $phoneflag;
        $user->phonecode = $request->input('phonecode');
        $user->iso_phone_code = $request->input('isophonecode');
        if ($request->input('isophoneflag') == "preferred") {
            $isophoneflag = "us";
        } else {
            $isophoneflag = $request->input('isophoneflag');
        }
        $user->iso_phone_flag = $isophoneflag;

        $user->director = $request->input('director');
        $user->sales_process = $request->input('sales_process');

        if ($request->file('company_profile')) {
            $imagePath = $request->file('company_profile');
            $imageName = uniqid() . "." . $request->file('company_profile')->extension();

            $path = $request->file('company_profile')->storeAs('/uploads/user', $imageName, 'public');
            $request->file('company_profile')->move(public_path('/uploads/user'), $imageName);

            $user->company_profile = $path;
        }

        if (Schema::hasColumns('users', ['audit_report'])) {
            if ($request->file('audit_report')) {
                if (File::exists(public_path($user->audit_report))) {
                    File::delete(public_path($user->audit_report));
                }
                $audit_report_path = $request->file('audit_report');
                $audit_report_name = uniqid() . "." . $request->file('audit_report')->extension();

                $audit_report_path = $request->file('audit_report')->storeAs('/uploads/user/audit_report', $audit_report_name, 'public');
                $request->file('audit_report')->move(public_path('/uploads/user/audit_report'), $audit_report_name);
                $user->audit_report = $audit_report_path;
            }
        }
        $user->audit_comment=$request->input('audit_comment');
        $user->expiry_date = $request->input('expiry_date');

        $user->company_name = $request->input('company_name');
        $user->company_address = $request->input('company_address');
        $user->purchasing_process = $request->input('purchasing_process');
        $user->servicing_process = $request->input('servicing_process');
        $user->competency_process = $request->input('competency_process');
        $user->scope = $request->input('business_scopes');
        $user->order_number = $request->input('order_number');
        $user->Company_overview = $request->input('Company_overview');

        $user->save();

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AddUsers  $addUsers
     * @return \Illuminate\Http\Response
     */

         public function interested_parties($request){
        //  dd($request);


 $id = intval($request);

        $interested=DB::table('interested_parties')->where('user_id',$id)->orderBy('id','DESC')->get();
        // dd($interested);
		//$auditreport=Qmsaudit::where('user_id',$request)->get();
        //return view('admin.adminform_records.interested_parties',compact('auditreport'));
        return view('admin.adminform_records.interested_parties',compact('interested','request'));
	}
    public function destroy(Request $req)
    {
        $userid=$req->id;
        $user=AddUsers::find($userid);
        if (File::exists(public_path($user->audit_report))) {
            File::delete(public_path($user->audit_report));
        }
        $user->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return redirect('/view_user')->with($notification);

    }

    public function updateadmin(Request $request)
    {

        $id=$request->requirment_id;
        $requirement= requirement::find($id);
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
        return redirect()->back();
        // return redirect("/requiremntCheck/$returnId")->with($notification);
    }
       //store audit info
    public function storeadminaudit(Request $request)
    {
		$this->validate($request,[
            'processAudit'=>'required',
            'auditor'=>'required',
            'auditDate'=>'required',
            'nonConformities'=>'required',
            'Observations'=>'required',
            'nonConfReport'=>'required',
            'AdutiActions'=>'required',
            'dateFrequency'=>'required',
        ]);

        try{
             $Audit= new Audit;
             $Audit->user_id=$request->user_id;
             $Audit->auditId=111;
             $Audit->processAudit=$request->input('processAudit');
             $Audit->auditor=$request->input('auditor');
             $Audit->auditDate=$request->input('auditDate');
             $Audit->nonConformities=$request->input('nonConformities');
             $Audit->Observations=$request->input('Observations');
             $Audit->nonConfReport=$request->input('nonConfReport');
             $Audit->AdutiActions=$request->input('AdutiActions');
             $Audit->dateFrequency=$request->input('dateFrequency');
             $Audit->qmsCorects=$request->input('qmsCorects');
             $Audit->evidence=$request->input('evidence');
             $Audit->needExpactations=$request->input('needExpactations');
             $Audit->evidance2=$request->input('evidance2');
             $Audit->correction3=$request->input('correction3');
             $Audit->evidence3=$request->input('evidence3');
             $Audit->correction4=$request->input('correction4');
             $Audit->evidance4=$request->input('evidance4');
             $Audit->correction5=$request->input('correction5');
             $Audit->evidence5=$request->input('evidence5');
             $Audit->correction6=$request->input('correction6');
             $Audit->evidance7=$request->input('evidance7');
             $Audit->correction7=$request->input('correction7');
             $Audit->evidance8=$request->input('evidance8');
             $Audit->correction9=$request->input('correction9');
             $Audit->evidance9=$request->input('evidance9');
             $Audit->correction10=$request->input('correction10');
             $Audit->evidance10=$request->input('evidance10');
             $Audit->any_issues=$request->input('any_issues');

            //Check if user attach evidence
            if ($request->file('attach_evidence') && Schema::hasColumn('tbl_audit','attach_evidence')) {
                $file = $request->file('attach_evidence');
                $path = '/uploads/user/attach_evidence/';
                $Audit->attach_evidence = HelperFunctions::saveFile($path,$file);
            }

             $Audit->save();

              return redirect()->back();
        }catch(Exception $exc){
            print_r($exc->getMessage());
        }
    }
    public function receive_notifications()
    {
        $notif = DB::table('users_messages')->orderBy('id', 'desc')->get();
		return view('admin.dashboard.admin.receive_notifications',compact('notif'));
    }  

    // updateauditadmin
    public function updateauditadmin(Request $request)
    {

        $id=$request->id;

        try{
            $Audit=Audit::find($id);
             $Audit->processAudit=$request->input('processAudit');
             $Audit->auditor=$request->input('auditor');
             $Audit->auditDate=$request->input('auditDate');
             $Audit->nonConformities=$request->input('nonConformities');
             $Audit->Observations=$request->input('Observations');
             $Audit->nonConfReport=$request->input('nonConfReport');
             $Audit->AdutiActions=$request->input('AdutiActions');
             $Audit->dateFrequency=$request->input('dateFrequency');

			  $Audit->qmsCorects=$request->input('qmsCorects');
             $Audit->evidence=$request->input('evidence');
             $Audit->needExpactations=$request->input('needExpactations');
             $Audit->evidance2=$request->input('evidance2');
             $Audit->correction3=$request->input('correction3');
             $Audit->evidence3=$request->input('evidence3');
             $Audit->correction4=$request->input('correction4');
             $Audit->evidance4=$request->input('evidance4');
             $Audit->correction5=$request->input('correction5');
             $Audit->evidence5=$request->input('evidence5');
             $Audit->correction6=$request->input('correction6');
             $Audit->evidance7=$request->input('evidance7');
             $Audit->correction7=$request->input('correction7');
             $Audit->evidance8=$request->input('evidance8');
             $Audit->correction9=$request->input('correction9');
             $Audit->evidance9=$request->input('evidance9');
             $Audit->correction10=$request->input('correction10');
             $Audit->evidance10=$request->input('evidance10');
             $Audit->any_issues=$request->input('any_issues');
            //Check if user attach evidence
            if ($request->file('attach_evidence') && Schema::hasColumn('tbl_audit','attach_evidence')) {
                //Delete previous attach evidence if exist
                if (File::exists(public_path($Audit->attach_evidence))) {
                    File::delete(public_path($Audit->attach_evidence));
                }

                $file = $request->file('attach_evidence');
                $path = '/uploads/user/attach_evidence/';
                $Audit->attach_evidence = HelperFunctions::saveFile($path,$file);
            }

             $Audit->save();

             return redirect()->back();
        }catch(Exception $exc){
            print_r($exc->getMessage());

            return redirect()->back();
        }

        // return redirect("/requiremntCheck/$returnId")->with($notification);
    }


    public function updateAuditCheck(Request $request){
        $id = $request->id;

        $Qmsaudit=Qmsaudit::find($id);

             $Qmsaudit->qmsCorects=$request->input('qmsCorects');
             $Qmsaudit->evidence=$request->input('evidence');
             $Qmsaudit->needExpactations=$request->input('needExpactations');
             $Qmsaudit->evidance2=$request->input('evidance2');
             $Qmsaudit->correction3=$request->input('correction3');
             $Qmsaudit->evidence3=$request->input('evidence3');
             $Qmsaudit->correction4=$request->input('correction4');
             $Qmsaudit->evidance4=$request->input('evidance4');
             $Qmsaudit->correction5=$request->input('correction5');
             $Qmsaudit->evidence5=$request->input('evidence5');
             $Qmsaudit->correction6=$request->input('correction6');
             $Qmsaudit->evidance7=$request->input('evidance7');
             $Qmsaudit->correction7=$request->input('correction7');
             $Qmsaudit->correction8=$request->input('correction8');
             $Qmsaudit->evidance8=$request->input('evidance8');
             $Qmsaudit->correction9=$request->input('correction9');
             $Qmsaudit->evidance10=$request->input('evidance10');
             $Qmsaudit->correction11=$request->input('correction11');
             $Qmsaudit->evidance12=$request->input('evidance12');
             $Qmsaudit->correction12=$request->input('correction12');
             $Qmsaudit->evidence13=$request->input('evidence13');
             $Qmsaudit->correction13=$request->input('correction13');
             $Qmsaudit->evidance14=$request->input('evidance14');
             $Qmsaudit->correction14=$request->input('correction14');
             $Qmsaudit->evidence17=$request->input('evidence17');
             $Qmsaudit->correction15=$request->input('correction15');
             $Qmsaudit->evidence15=$request->input('evidence15');
             $Qmsaudit->correction16=$request->input('correction16');
             $Qmsaudit->correciton17=$request->input('correciton17');
             $Qmsaudit->evidence18=$request->input('evidence18');
             $Qmsaudit->correction18=$request->input('correction18');
             $Qmsaudit->evidence19=$request->input('evidence19');
             $Qmsaudit->correction19=$request->input('correction19');
             $Qmsaudit->evidence20=$request->input('evidence20');
             $Qmsaudit->correction20=$request->input('correction20');
             $Qmsaudit->evidence21=$request->input('evidence21');
             $Qmsaudit->correction21=$request->input('correction21');
             $Qmsaudit->evidence22=$request->input('evidence22');
             $Qmsaudit->correction22=$request->input('correction22');
             $Qmsaudit->evidence23=$request->input('evidence23');
             $Qmsaudit->correction23=$request->input('correction23');
             $Qmsaudit->evidence24=$request->input('evidence24');
             $Qmsaudit->correction24=$request->input('correction24');
             $Qmsaudit->evidence25=$request->input('evidence25');
             $Qmsaudit->correction25=$request->input('correction25');
             $Qmsaudit->evidence26=$request->input('evidence26');
             $Qmsaudit->correction26=$request->input('correction26');
             $Qmsaudit->evidence27=$request->input('evidence27');
             $Qmsaudit->correction27=$request->input('correction27');
             $Qmsaudit->evidence28=$request->input('evidence28');
             $Qmsaudit->evidence31=$request->input('evidence31');
             $Qmsaudit->competedDate=$request->input('competedDate');
             $Qmsaudit->auditrName=$request->input('auditrName');

             $Qmsaudit->save();
             return redirect()->back();
    }

    public function destroyreq(Request $req)
    {
        // $userid=$req->req_id;
        $userid=$req->id;
        // echo $userid;exit;
        $req=requirement::find($userid)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return redirect()->back();


    }
     /*work for chemical control*/
    public function chemicalcheck($request)
    {
        $chemical=Chemical::where('user_id',$request)->orderBy('id','DESC')->get();
        return view('admin.adminform_records.chemical_record',compact('chemical'));
    }
     public function deleteChemical2(Request $request)
    {
        // dd($request->id);
        $userid=$request->id;
        $req=Chemical::find($userid)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return redirect()->back();
    }

    /*end*/
    public function destroyaudit(Request $req)
    {
        $id=$req->id;
        $audit = Audit::find($id);
        if (File::exists(public_path($audit->attach_evidence))) {
            File::delete(public_path($audit->attach_evidence));
        }
        $audit->delete();

        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return redirect()->back();


    }
    public function auditdeleter(Request $req)
    {
        $userid=$req->id;
        $req=Qmsaudit::find($userid)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return redirect()->back();


    }
    public function deleteNonConfrm(Request $req)
    {
        $userid=$req->id;
        $req=Nonconform::find($userid)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return redirect()->back();


    }
    public function deletecustomeradmin(Request $req)
    {
        $userid=$req->id;
        $req=customers::find($userid)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return redirect()->back();


    }
    public function deleteCustomerRivewAdmin(Request $req)
    {
        $userid=$req->id;
        $req=customer_review::find($userid)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return redirect()->back();


    }
    public function deleteSupplierAdmin(Request $req)
    {
        $userid=$req->id;
        $req=Supplier::find($userid)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return redirect()->back();


    }
    public function deletecaliberinfo(Request $req )
    {
        $userid=$req->id;
        $req=calibration::find($userid)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return redirect()->back();


    }
     public function deleteEmployeeskill(Request $req)
    {
        $userid=$req->id;
        $req=DB::table('tbl_employees_skills')->where('skill_id', $userid)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return redirect()->back();


    }
    public function deleteEmployeeadmin(Request $request)
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

        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return redirect()->back();


    }
    public function deletemgtreviewadmin(Request $req)
    {
        $userid=$req->id;
        $req=Mgtreview::find($userid)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return redirect()->back();


    }
    public function deletemaintanceRecAdmin(Request $req)
    {
        $userid=$req->id;
        $req=Maintain_rec::find($userid)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return redirect()->back();


    }
    public function deleteRiskadmin(Request $req)
    {
        $userid=$req->id;
        $req=AccidentRisk::find($userid)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return redirect()->back();


    }
    public function deleteAssesmnetadmin(Request $req)
    {
        $userid=$req->id;
        $req=Assessment::find($userid)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return redirect()->back();


    }
    public function deleteWorkadmin(Request $req)
    {
        $userid=$req->id;
        $req=Workinstructions::find($userid)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return redirect()->back();


    }

    public function quality_manual(Request $request){
        $userid= Auth::user()->id;
        $user=User::where('id',$userid)->first();

         return view('dashboard.mannual_policy.quality_manual',compact('user'));

    }
    public function UpdateUserInfo(Request $request){
        // return "sfdfds";
        $id=$request->id;
        $Company_overview=$request->input('Company_overview');
        $user=AddUsers::find($id);
        if($request->input('password') !='' || !empty($request->input('password'))){
            $pass=$request->input('password');
            $user->password=Hash::make($pass);
        }
        $user->phone=$request->input('phone');
        $user->director=$request->input('director');
        $user->sales_process=$request->input('sales_process');
      $user->company_profile=$request->input('company_profile');
      $user->company_address=$request->input('company_address');
      $user->purchasing_process=$request->input('purchasing_process');
      $user->servicing_process=$request->input('servicing_process');
      $user->competency_process=$request->input('competency_process');
      $user->scope=$request->input('scope');
      $user->order_number=$request->input('order_number');
        $user->Company_overview=$request->input('Company_overview');
      $user->save();

    }

    public function all_faqs(){
		$all_faqs  = DB::table('faqs')->get();
		$all_cate  = DB::table('faqs_categories')->get();
        return view('admin.dashboard.admin.view_faqs', compact('all_faqs'), compact('all_cate'));
    }

    public function add_faq(Request $request){
            $insert = DB::table('faqs')->insert(
				array(
					'question' => $request['question'],
					'answer' => $request['answer'],
					'category' => $request['category']
				)
			);
	session()->flash('msg', 'Question added successfully.');
    return redirect()->back();
    }

    public function add_faq_cate(Request $request){
        $insert = DB::table('faqs_categories')->insert(
			array('name' => $request['faq_cate'])
		);
	session()->flash('msg', 'Category added successfully.');
    return redirect()->back();
    }
	public function faq_edit($id){
		$faq  = DB::table('faqs')->where('id', $id)->first();
		//$faq  = DB::select( DB::raw("SELECT * FROM faqs WHERE id = '$id'") )->get();
		//dd($faq);
		$all_cate  = DB::table('faqs_categories')->get();
		//dd($all_cate);
        return view('admin.dashboard.admin.faq_edit', compact('faq'), compact('all_cate'));
	}

	public function faq_update(Request $request){
		//dd($request);
		DB::table('faqs')->where('id', $request['id'])->update(
				array(
					'question' => $request['question'],
					'answer' => $request['answer'],
					'category' => $request['category']
				)
			);
	session()->flash('msg', 'Question updated successfully.');
    return redirect(url('/all_faqs'));
	}

	public function faq_delete(Request $request){
		DB::table('faqs')->delete($request['id']);
			session()->flash('msg', 'FAQ deleted successfully.');
    return redirect()->back();
	}

	public function cat_delete(Request $request){
		DB::table('faqs_categories')->delete($request['id']);
			session()->flash('msg', 'Category deleted successfully.');
        return redirect()->back();
	}

    public function add_quick_link(Request $request){
            $insert = DB::table('quick_links')->insert(
				array(
					'title' => $request['title'],
					'link' =>  $request['link'],
					'category' => $request['category']
				)
			);
	session()->flash('msg', 'Quick link added successfully.');
    return redirect()->back();
    }

    public function all_quick_links(){
        $quick_links  = DB::table('quick_links')->get();
		$all_cate  = DB::table('quick_links_categories')->get();
        return view('admin.dashboard.admin.view_quick_links', compact('quick_links'), compact('all_cate'));
    }

    public function add_quicklink_cate(Request $request){
    $insert = DB::table('quick_links_categories')->insert(
			array('name' => $request['quicklink_cate'])
		);
	session()->flash('msg', 'Quick link category added successfully.');
	 return redirect(url('/all_quick_links'));

    }

	public function quick_link_edit($id){
		$quick_link  = DB::table('quick_links')->where('id', $id)->first();
		$all_cate  = DB::table('quick_links_categories')->get();
        return view('admin.dashboard.admin.quick_link_edit', compact('quick_link'), compact('all_cate'));
	}

	public function quick_link_update(Request $request){

		DB::table('quick_links')->where('id', $request['id'])->update(
				array(
					'title' => $request['title'],
					'link' => 	$request['link'],
					'category' => $request['category']
				)
			);
	session()->flash('msg', 'Quick link updated successfully.');
    return redirect(url('/all_quick_links'));
	}

    public function quick_link_delete(Request $request){
		DB::table('quick_links')->delete($request['id']);
			session()->flash('msg', 'Quick link deleted successfully.');
    return redirect()->back();
	}

	 public function quick_link_category_delete(Request $request){
		DB::table('quick_links_categories')->delete($request->category_id);
		session()->flash('msg', 'Category deleted successfully.');
        return redirect()->back();
	}
/**/

    public function add_video(Request $request){


			$path='';
        if ($request->file('video')) {
			   $request->validate([
            'video' => 'required|mimes:mp4,avi|max:40096'
            ]);
            $vidPath = $request->file('video');
            $vidName = uniqid().".".$request->file('video')->extension();
            $path = $request->file('video')->storeAs('uploads/explainer_videos', $vidName, 'public');
          $request->file('video')->move(public_path('uploads/explainer_videos'), $vidName);

        }

           $insert = DB::table('videos')->insert(
				array(
					'title' => $request['title'],
					'video' => $vidName
				)
			);

	session()->flash('msg', 'Video added successfully.');
    return redirect()->back();
    }

    public function all_videos(){
        $all_videos  = DB::table('videos')->get();
		return view('admin.dashboard.admin.view_videos', compact('all_videos'));
    }


	public function video_edit($id){
		$video  = DB::table('videos')->where('id', $id)->first();
        return view('admin.dashboard.admin.video_edit', compact('video'));
	}

	public function video_update(Request $request){

		DB::table('videos')->where('id', $request['id'])->update(
				array(
					'title' => $request['title'],
					'video' => $request['video']
				)
			);
	session()->flash('msg', 'Video updated successfully.');
    return redirect(url('/all_videos'));
	}

    public function video_delete(Request $request){
		DB::table('videos')->delete($request['id']);
			session()->flash('msg', 'Video deleted successfully.');
    return redirect()->back();
	}

     public function check_order_number()
    {

        //echo 'hey there'; exit;
        // dd($_GET);
        $num_check=AddUsers::where('order_number',$_GET['number'])->get();
        if(count($num_check)>0)
        {
            echo"exists";
        }

    }

    public function checkEmpNumber(Request $request){
        try {
            $validator = \Validator::make($request->all(), [
                'userId' => 'required|exists:users,id',
                'empNumber' => 'required',
                'type' => 'required',
            ]);

            if ($validator->fails())
            {
                return response()->json([
                    'message'=> 'Please try again ,validation failed',
                    'status'=> 0
                ]);
            }

            $result = Employee::where("user_id",$request->userId)
                ->where("empNumber",$request->empNumber);

            if ($request->type == 'edit'){
                $result = $result->where("id",'<>',$request->empId);
            }

            $result = $result->exists();
            return response()->json([
                'message'=> $result ? "The Employee ID Number $request->empNumber is already exists" : '',
                'status'=> $result ? 0 : 1
            ]);
        }catch (\Exception $exception){
            return response()->json([
                'message'=> 'Please try again ,validation failed',
                'status'=> 0
            ]);
        }
    }

}
