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
use App\Maintain_rec;
use App\Mgtreview;
use App\Nonconform;
use App\Qmsaudit;
use App\requirement;
use App\SendNotifications;
use App\Supplier;
use App\Workinstructions;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('Here');
        $users=AddUsers::where('role_type','user')->get();
        return view('admin.dashboard.admin.view_user',compact('users'));
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

        try{
            $this->validate($request,[
                'name'=>'required',
                'password'=>'required',
                'email'=>'required'

            ]);
            if ($request->file('user_image')) {
                $imagePath = $request->file('user_image');
                $imageName = uniqid().".".$request->file('user_image')->extension();

                $path = $request->file('user_image')->storeAs('uploads/user', $imageName, 'public');
              $request->file('user_image')->move(public_path('uploads/user'), $imageName);
          }
            $pass=$request->input('password');
            $addusers= new AddUsers();
            $addusers->name=$request->input('name');
            $addusers->email=$request->input('email');
            $addusers->password=Hash::make($pass);
            $addusers->persone_iso=$request->input('person_iso');
            $addusers->contact_number_iso=$request->input('contact_iso');
            $addusers->emailaddress_iso=$request->input('email_iso');
            $addusers->country=$request->input('country');
            $addusers->phone=$request->input('phone');
            $addusers->director=$request->input('director');
            $addusers->sales_process=$request->input('sales_process');
           $addusers->company_profile=$request->input('company_profile');
           $addusers->company_name=$request->input('company_name');
           $addusers->company_address=$request->input('company_address');
           $addusers->role_type='user';
           $addusers->purchasing_process=$request->input('purchasing_process');
           $addusers->servicing_process=$request->input('servicing_process');
           $addusers->competency_process=$request->input('competency_process');
           $addusers->scope=$request->input('scope');
           $addusers->order_number=$request->input('order_number');
           $addusers->Company_overview=$request->input('Company_overview');
           $addusers->profile_image=$path;
           $current = Carbon::now();
           $expiry=$current->addYears(2);
           $addusers->expiry_date=$expiry;

           $addusers->save();
           return redirect('/add_user')->with("Success","Data Save Successfully");
          }catch(Exception $exc){
           return redirect('/add_user')->with("Error","Error");

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
        $getReq=requirement::where('user_id',$request)->get();


        return view('admin.adminform_records.requirements_aspect',compact('getReq'));

    }

    public function ProcessCheck($request)
    {
        $getprocess=Audit::where('user_id',$request)->get();


        return view('admin.adminform_records.process_audit',compact('getprocess'));

    }
    public function send_notifications()
    {
        // $getprocess=Audit::where('user_id',$request)->get();
        $users=AddUsers::where('role_type','user')->get();
        $adminmessage=SendNotifications::join('users','users.id','=','send_notification.send_to')->get();
        //  $adminmessage=SendNotifications::get();



        return view('admin.dashboard.admin.send_notifications',compact('users','adminmessage'));

    }
    public function sendNotifications(Request $request){
        print_r($request->all());
        $sendNotification= new SendNotifications();
            $sendNotification->title=$request->input('title');
            $sendNotification->message=$request->input('message');
           $sendNotification->send_to=$request->input('userid');
           $sendNotification->save();

           return redirect()->back();

    }

    public function AuditsCheck($request){
        $auditreport=Qmsaudit::where('user_id',$request)->get();
        return view('admin.adminform_records.qms_audit',compact('auditreport'));

    }
    public function nonConformCheck($request){
        $noneConform=Nonconform::where('user_id',$request)->get();
        return view('admin.adminform_records.non_conformities',compact('noneConform'));

    }
    public function customerCheck($request){
        $customer=customers::where('user_id',$request)->get();
        return view('admin.adminform_records.customer',compact('customer'));

    }

    public function customerReviewad($request){
        $customer_review=customer_review::where('user_id',$request)->get();
        return view('admin.adminform_records.customer_review',compact('customer_review'));

    }
    public function supplierCheck($request){
        $supplier=Supplier::where('user_id',$request)->get();
        return view('admin.adminform_records.supplier',compact('supplier'));

    }
    public function calibrationcheck($request){
        $caliber=calibration::where('user_id',$request)->get();
        return view('admin.adminform_records.calibration_record',compact('caliber'));

    }
    public function EmployeCheck($request){

        $userinfo=Employee::where('user_id',$request)->get();
        $employess=Employee::join('tbl_employees_skills','tbl_employees_skills.empid','=','tbl_employees.id')->  where('tbl_employees.user_id',$request)->get();
        $emptraining=Employee::join('tbl_employees_traning','tbl_employees_traning.empid','=','tbl_employees.id')->  where('tbl_employees.user_id',$request)->get();
        return view('admin.adminform_records.employess',compact('userinfo','employess','emptraining'));

    }
    public function managementCheck($request){

        $mgtrev=Mgtreview::where('user_id',$request)->get();
        return view('admin.adminform_records.managment_reviews',compact('mgtrev'));

    }
    public function maintainRecCheck($request){

        $mainrecord=Maintain_rec::where('user_id',$request)->get();
        return view('admin.adminform_records.maintance_record',compact('mainrecord'));

    }
    public function AccidentCheck($request){

        $riskassesment=AccidentRisk::where('user_id',$request)->get();
        return view('admin.adminform_records.accident_risk_assesment',compact('riskassesment'));

    }
    public function riskAssesmntCheck($request){
        $riskassesment=Assessment::where('user_id',$request)->get();
        return view('admin.adminform_records.risk_assessment',compact('riskassesment'));
    }
    public function workinstructionCheck($request){
        dd($request);
        $work=Workinstructions::where('user_id',$request)->get();
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
        //dd($request->all());exit;
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
       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AddUsers  $addUsers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        $userid=$req->id;
        $req=AddUsers::find($userid)->delete();
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
        $userid=$req->id;
        $req=requirement::find($userid)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return redirect()->back();


    }
    public function destroyaudit(Request $req)
    {
        $userid=$req->id;
        $req=Audit::find($userid)->delete();
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
    public function deletecaliberinfo(Request $req)
    {
        $userid=$req->id;
        $req=calibration::find($userid)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return redirect()->back();


    }
    public function deleteEmployeeadmin(Request $req)
    {
        $userid=$req->id;
        $req=Employee::find($userid)->delete();
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

    public function UpdateUserInfo(Request $request){
        return "sfdfds";
    //     $id=$request->id;
    //     $Company_overview=$request->input('Company_overview');
    //     $user=AddUsers::find($id);
    //     if($request->input('password') !='' || !empty($request->input('password'))){
    //         $pass=$request->input('password');
    //         $user->password=Hash::make($pass);
    //     }
    //     $user->phone=$request->input('phone');
    //     $user->director=$request->input('director');
    //     $user->sales_process=$request->input('sales_process');
    //   $user->company_profile=$request->input('company_profile');
    //   $user->company_address=$request->input('company_address');
    //   $user->purchasing_process=$request->input('purchasing_process');
    //   $user->servicing_process=$request->input('servicing_process');
    //   $user->competency_process=$request->input('competency_process');
    //   $user->scope=$request->input('scope');
    //   $user->order_number=$request->input('order_number');
    //     $user->Company_overview=$request->input('Company_overview');
    //   $user->save();

    }






}
