<?php

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RequiremntController;
use App\Http\Controllers\CertificateController;
use App\requirement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ThreeMonthNotification;
use App\Notifications\SixMonthNotification;
use App\Notifications\TenMonthNotification;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('/UpdateUserInfo', 'UserInfoController@user')->name('UpdateUserInfo');
Route::post('/updateuserinfo', 'UserInfoController@user')->name('updateuserinfo')->middleware(['auth','admin']);
Route::get('/certificates','CertificateController@checkCertificate');

Route::get('/clear', function() { Artisan::call('cache:clear'); return "Cache is cleared"; });
Route::get('/', function () { return view('auth.login'); })->middleware(['guest']);
//Route::post('password-reset-email', 'Auth\ResetPasswordController@passwordResetEmail')->name('password.reset.email')->middleware(['guest']);
Route::post('password-reset-email', 'Auth\ResetPasswordController@passwordResetEmail')->name('password.reset.email');
Route::get('/forgot', function () { return view('auth.forgot'); });

// Route::post('/loginroute','Auth.LoginController')->name('loginroute');

Route::get('/logout', function () { Auth::logout();
    $notification = [
        'message' => 'Logout Successfully.!',
        'alert-type' => 'success'
    ];
    return redirect('/')->with($notification);
});

Auth::routes();

/*************** All user urls and routes start ***************/

Route::group(['middleware' => ['auth','usermiddle']], function () 
{
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/work_instruction', 'WorkInstructionController@index');
    Route::view('/userprofile','dashboard.procedure.userprofile')->name('userprofile');
    Route::view('/customer', 'dashboard.customer.index');
    Route::get('/requirements_aspect','RequiremntController@index');
    Route::get('/process_audit','auditController@index');

    Route::post('/generate-pdf', 'auditController@generatePDF')->name('generate-pdf');
    Route::post('/download-pdf', 'auditController@downloadPDF')->name('download-pdf');

    Route::post('/chemical_control_delete','chemicalController@destroy_chemical');
    Route::get('/qms_audit','qmsauditController@index');

    Route::post('/generate-pdf-qms', 'qmsauditController@generatePDFgms')->name('generate-pdf-qms');
    Route::post('/download-pdf-qms', 'qmsauditController@downloadPDFqms')->name('download-pdf-qms');

    
    Route::get('/non_confromities','nonConfromFormController@index');
    Route::get('/customer','CustomerController@index');
    Route::get('/customer_review', 'CustomerReviewController@index');
    Route::get('/supplier', 'SupplierController@index');
    Route::get('/calibration_record','CalibrationController@index');
    Route::post('/calibration_delete','CalibrationController@destroy');
    Route::get('/employess', 'EmployeeController@index');
    Route::get('/add_management_review', 'MgtreviewController@index');
    Route::get('/maintance_record','MaintainRecController@index');
    Route::get('/accident_risk','AccidentRiskController@index');
    Route::get('/risk_assessment','AssessmentController@index');

    /*************** Manual and policies urls and routes start ***************/
    Route::get('/quality_manual', 'AddUsersController@quality_manual');
    Route::get('/quality_policy', 'AddQualityController@quality_policy')->name('add_quality');
    Route::get('/environment_policy', 'AddQualityController@environment_policy')->name('environment_policy');
    Route::get('/health_policy', 'AddQualityController@health_policy')->name('health_policy');

    // Route::view('/quality_policy', 'dashboard.mannual_policy.quality_policy');
    // Route::view('/enviornment_policy', 'dashboard.mannual_policy.enviornment_policy');
    // Route::view('/health_policy', 'dashboard.mannual_policy.health_safety_policy');

    Route::get('/management_organogram','ImagesUploadController@management_organogram');
    Route::post('/add_quality','AddQualityController@add_quality')->name('add_quality');
    Route::post('/environment_policy','AddQualityController@add_environmental_policy')->name('environment_policy');
    Route::post('/health_policy','AddQualityController@add_health_policy')->name('health_policy');


    // Route::post('/addaddionalpolices','dashboard.mannual_policy.quality_policy');

    /*************** Manual and policies urls and routes end ***************/

    /*************** Prcesses urls and routes start ***************/
    Route::get('/sale_processes','ImagesUploadController@sale_process');
    Route::get('/purchasing_processes','ImagesUploadController@purchasing_process');
    Route::get('/servicing_contract','ImagesUploadController@servicing_contract');
    Route::get('/competency_process','ImagesUploadController@competency_process');
    Route::get('/process_interaction','ImagesUploadController@process_interaction');
    /*************** Prcesses urls and routes end ***************/

    /*************** Procedure urls and routes start ***************/
    Route::view('/documented_information', 'dashboard.procedure.documented_information');
    Route::view('/corrective_action', 'dashboard.procedure.corective_action');
    Route::view('/management_review', 'dashboard.procedure.management_review');
    Route::view('/monitoring_measure', 'dashboard.procedure.monitoring_measure');
    Route::view('/auidt', 'dashboard.procedure.audits');
    /*************** Procedure urls and routes end ***************/

});

Route::get('/audit', function () 
{
    return view('admin.adminform_records.audit');
});



/*************** All user urls and routes end ***************/

/*************** All admin urls and routes start ***************/
Route::group(['middleware' => ['auth','admin']], function () 
{
    Route::get('/admin', 'AdminController@index');
    Route::get('/view_user', 'AddUsersController@index');
    Route::post('/add_user', 'AddUsersController@store')->name('add_user');
    Route::post('/deleteuserd', 'AddUsersController@destroy')->name('deleteuserd');
    Route::post('/updateuserinfo', 'AddUsersController@update')->name('updateuserinfo');
    Route::get('/send_notifications', 'AddUsersController@send_notifications');
    Route::get('/receive_notifications', 'AddUsersController@receive_notifications');
    Route::get('/send_message', 'AddUsersController@send_message')->name('send.message');
    Route::get('/fetch_users', 'AddUsersController@fetchUsers')->name('fetch.users');
    Route::get('/sent_notification', 'AddUsersController@sentNotification')->name('sentNotification');
    Route::get('/received_Notification', 'AddUsersController@receivedNotifications')->name('receiveNotification');
    Route::get('/message', 'AddUsersController@individualMessageAdmin')->name('individualMessage');
    // Route::get('/admin', 'AddUsersController@unreadMessages')->name('unreadMessages');
    Route::post('/storeReplyMessageAdmin', 'AddUsersController@storeReplyMessageAdmin')->name('storeReplyMessageAdmin');
    Route::post('/add_faq', 'AddUsersController@add_faq');
    Route::post('/add_faq_cate', 'AddUsersController@add_faq_cate');
    Route::get('/faq_edit/{id}', 'AddUsersController@faq_edit');
    Route::post('/faq_update/{id}', 'AddUsersController@faq_update');
    Route::post('/faq_delete/{id}', 'AddUsersController@faq_delete');
    Route::get('/all_faqs', 'AddUsersController@all_faqs');
    Route::post('/cat_delete/{id}', 'AddUsersController@cat_delete');
    Route::post('/mark-as-read', 'AddUsersController@markAsRead')->name('markasread');

    Route::post('/add_video', 'AddUsersController@add_video');
    Route::get('/video_edit/{id}', 'AddUsersController@video_edit');
    Route::post('/video_update/{id}', 'AddUsersController@video_update');
    Route::post('/video_delete/{id}', 'AddUsersController@video_delete');
    Route::get('/all_videos', 'AddUsersController@all_videos');

    Route::post('/add_quick_link', 'AddUsersController@add_quick_link');
    Route::post('/add_quicklink_cate', 'AddUsersController@add_quicklink_cate');
    Route::get('/quick_link_edit/{id}', 'AddUsersController@quick_link_edit');
    Route::post('/quick_link_update/{id}', 'AddUsersController@quick_link_update');
    Route::post('/quick_link_delete/{id}', 'AddUsersController@quick_link_delete');
    Route::get('/all_quick_links', 'AddUsersController@all_quick_links');
    Route::post('quick_link_category_delete', 'AddUsersController@quick_link_category_delete');

    Route::get('/interested_parties/{id}', 'AddUsersController@interested_parties');
    Route::post('/updaterequiremntadmin', 'AddUsersController@updateadmin')->name('updaterequiremntadmin');
    Route::post('/auditupdateadmin', 'AddUsersController@updateauditadmin')->name('auditupdateadmin');
    Route::post('/auditsaveadmin','AddUsersController@storeadminaudit')->name('auditsaveadmin');
    Route::post('/deleteauditadmin', 'AddUsersController@destroyaudit')->name('deleteauditadmin');
    Route::post('/auditdeleter', 'AddUsersController@auditdeleter')->name('auditdeleter');

    Route::view('/add_user', 'admin.dashboard.admin.add_user');

    Route::post('/deleteCustomerRivewAdmin', 'AddUsersController@deleteCustomerRivewAdmin')->name('deleteCustomerRivewAdmin');
    Route::post('/deleteSupplierAdmin', 'AddUsersController@deleteSupplierAdmin')->name('deleteSupplierAdmin');
    Route::post('/deleteEmployeeadmin', 'AddUsersController@deleteEmployeeadmin')->name('deleteEmployeeadmin');
    Route::post('/deleteEmployeeskill', 'AddUsersController@deleteEmployeeskill')->name('deleteEmployeeskill');
    Route::post('/deletemgtreviewadmin', 'AddUsersController@deletemgtreviewadmin')->name('deletemgtreviewadmin');
    Route::post('/deletemaintanceRecAdmin', 'AddUsersController@deletemaintanceRecAdmin')->name('deletemaintanceRecAdmin');
    Route::post('/deleteRiskadmin', 'AddUsersController@deleteRiskadmin')->name('deleteRiskadmin');
    Route::post('/deleteAssesmnetadmin', 'AddUsersController@deleteAssesmnetadmin')->name('deleteAssesmnetadmin');
    Route::post('/deleteWorkadmin', 'AddUsersController@deleteWorkadmin')->name('deleteWorkadmin');
    Route::post('/sendNotifications', 'AddUsersController@sendNotifications')->name('sendNotifications');

    Route::post('/deleteNotifications', 'AddUsersController@deleteNotifications')->name('deleteNotifications');
    Route::post('/deleteMessage', 'AddUsersController@deleteMessage')->name('deleteMessage');
    Route::post('/deleteChemical', 'AddUsersController@deletechemicaladmin')->name('deletechemicaladmin');
    Route::post('/deleteChemical2', 'AddUsersController@deleteChemical2')->name('deleteChemical2');

    // showing badge on notification sidebar
    Route::post('/messageCounter', 'AddUsersController@showUnreadMessage')->name('showUnreadMessage');
    // Show download Histroy of User by Admin
    Route::post('/userdownloadhistory', 'AddUsersController@userDownloadHistory')->name('userloginhistory');
    // Show Login Histroy of User by Admin
    Route::post('/userloginhistory', 'AddUsersController@userLoginHistory')->name('userloginhistory');

    // Route for showing the email details of clients who haven`t login for 3, 6 or 10 months 
    Route::post('/user-email-details', 'AddUsersController@userEmailDetails')->name('user.email.details');

    Route::view('/edit_user/{id}', 'admin.dashboard.admin.edit_user');

    // View user details page
    Route::get('/requiremntCheck/{userid}', 'AddUsersController@requirementcheck');
    Route::get('/ProcessCheck/{userid}', 'AddUsersController@ProcessCheck');
    Route::get('/AuditsCheck/{userid}', 'AddUsersController@AuditsCheck');
    Route::get('/nonConformCheck/{userid}', 'AddUsersController@nonConformCheck');
    Route::get('/customerCheck/{userid}', 'AddUsersController@customerCheck');
    Route::get('/customerReviewad/{userid}', 'AddUsersController@customerReviewad');
    Route::get('/supplierCheck/{userid}', 'AddUsersController@supplierCheck');
    Route::get('/calibrationcheck/{userid}', 'AddUsersController@calibrationcheck');
    Route::get('/chemicalcheck/{userid}', 'AddUsersController@chemicalcheck')->name("chemicalcheck");
    Route::get('/EmployeCheck/{userid}', 'AddUsersController@EmployeCheck');
    Route::get('/managementCheck/{userid}', 'AddUsersController@managementCheck');
    Route::get('/maintainRecCheck/{userid}', 'AddUsersController@maintainRecCheck');
    Route::get('/AccidentCheck/{userid}', 'AddUsersController@AccidentCheck');
    Route::get('/riskAssesmntCheck/{userid}', 'AddUsersController@riskAssesmntCheck');
    Route::get('/workinstructionCheck/{userid}', 'AddUsersController@workinstructionCheck');
    Route::get('/additionalpolicies/{userid}', 'AddUsersController@additionalpolicies');

    // Login_History show 
    Route::post('/login-history', 'App\Http\Controllers\Auth\LoginController@login_history')->name('login-history');

    // to manage downloads
    Route::get('/upload', 'AddUsersController@manage_uploads');
    Route::post('/add_download', 'AddUsersController@add_download');
    Route::post('/download_delete/{id}', 'AddUsersController@download_delete');
    Route::get('/view_users_downloads', 'AddUsersController@viewUsersDownloads');
    Route::get('/downloads/filter', 'AddUsersController@filter')->name('downloads.filter');

});

/*************** All admin urls and routes end ***************/

/*************** Auth middleware implemented on these urls start ***************/

Route::group(['middleware' => ['auth']], function () 
{

    Route::post('/deletecaliberinfo', 'AddUsersController@deletecaliberinfo')->name('deletecaliberinfo')->middleware(['auth']);
    Route::get('/ajax/products', 'ProductController@fetchAllProducts')->name('ajax-products');
    Route::get('/ajax/users', 'UserController@fetchAllUsers')->name('ajax-users');
    Route::resources([ 'products' => 'ProductController','users' => 'UserController',]);

    /*********** Document Required start ***********/
    Route::get('/document_required', 'WorkInstructionController@doc_req');
    
    /*********** Document Required end ***********/

    Route::get('user-profile/{id}', 'ShowProfile');

    /*********** Form & Records ***********/
    Route::get('/interesting_parties','interestedController@index');
    Route::get('/chemical_control','chemicalController@index');
    Route::post('/get_customer_name_by_id', 'nonConfromFormController@get_customer_name_by_id');
    Route::post('/get_employee_name_by_id', 'nonConfromFormController@get_employee_name_by_id');


    Route::get('/customer/check','CustomerController@check_customer')->name('checkcustomer');
    Route::post('/employess-delete', 'EmployeeController@destroy')->name('employess-delete');
    Route::post('/update-employes-skill', 'EmployeeController@updateempSkills')->name('update-employes-skill');
    Route::post('/update-employes-training', 'EmployeeController@updateemptraining')->name('update-employes-training');
    Route::post('/delete_assesment','AssessmentController@destroy')->name('delete_assesment');

    Route::get('/view_work', function () 
    {
        return view('dashboard.view_work_instruction.view_work_instruction');
    });

    Route::get('/contact_us', 'UserMsgController@index');

    /**************post Methods are Down*****************/
    // Route::post("/requirementForm",'requirementAspacts')->name("requirementForm");
    Route::post('/requiemntform','RequiremntController@store')->name('requiemntform');
    Route::post('/auditform','auditController@store')->name('auditform');
    Route::post('/interestedform','interestedController@store')->name('interestedform');
    Route::post('/chemicalform','chemicalController@store')->name('chemicalform');
    Route::post('/qmsaudit','qmsauditController@store')->name('qmsaudit');
    Route::post('/nonConfromForm','nonConfromFormController@store')->name('nonConfromForm');
    Route::post('/customerform','CustomerController@store')->name('customerform');
    Route::post('/customer_rview','CustomerReviewController@store')->name('customer_rview');
    Route::post('/supplier','SupplierController@store')->name('supplier');
    Route::post('/calibration','CalibrationController@store')->name('calibration');
    Route::post('/employee','EmployeeController@store')->name('employee')->middleware(['auth']);
    Route::post('/empSkills','EmployeeController@empSkills')->name('empSkills');
    Route::post('/empTraining','EmployeeController@empTraining')->name('empTraining');
    Route::post('/mgtreview','MgtreviewController@store')->name('mgtreview');
    Route::post('/maintain_rec','MaintainRecController@store')->name('maintain_rec');
    Route::post('/accident_risk','AccidentRiskController@store')->name('accident_risk');
    Route::post('/assessment','AssessmentController@store')->name('assessment');
    Route::post('/workinstructions','WorkInstructionController@store')->name('workinstructions');

    // update routes

    Route::post('/updaterequiremnt','RequiremntController@update')->name('updaterequiremnt');
    Route::post('/auditDelete','auditController@update')->name('auditDelete');
    Route::post('/interestedUpdate','interestedController@update')->name('interestedUpdate');
    Route::post('/chemicalUpdate','chemicalController@update')->name('chemicalUpdate');

    // nonConfromFormEdit

    Route::post('/nonConfromFormEdit','nonConfromFormController@update')->name('nonConfromFormEdit');
    Route::post('/supplieredit','SupplierController@update')->name('supplieredit');
    Route::post('/mgtreviewupdate','MgtreviewController@update')->name('mgtreviewupdate');
    Route::post('/editassessment','AssessmentController@update')->name('editassessment');
    Route::post('/editnonConfirm','nonConfromFormController@update')->name('editnonConfirm');
    Route::post('/editCustomers','CustomerController@update')->name('editCustomers');
    Route::post('/editCustomerReview','CustomerReviewController@update')->name('editCustomerReview');
    Route::post('/calibrationedit','CalibrationController@update')->name('calibrationedit');
    Route::post('/editemployee','EmployeeController@update')->name('editemployee');
    Route::post('/editmentainance','MaintainRecController@update')->name('editmentainance');
    Route::post('/accidentedit','AccidentRiskController@update')->name('accidentedit');
    Route::post('/editworkinstructions','WorkInstructionController@update')->name('editworkinstructions');
    Route::post('/update_qmsaudit','qmsauditController@update')->name('update_qmsaudit');
    Route::get('/inboxmessage','SendNotificationsController@oldNotifications');
    Route::get('/create-message', 'SendNotificationsController@createUserMessage')->name('storeMessage');
    Route::post('/store-message', 'SendNotificationsController@storeNotification')->name('storeNotification');
    Route::get('/received-messages', 'SendNotificationsController@index')->name('inboxMessages');
    Route::get('/sent_messages', 'SendNotificationsController@sentNotifications')->name('sentMessages');
    Route::get('/user-message', 'SendNotificationsController@individualMessageUser')->name('individualMessageUser');
    Route::post('/storeReplyMessageUser', 'SendNotificationsController@storeReplyMessageUser')->name('storeReplyMessageUser');
    Route::post('/mark-as-read-user', 'SendNotificationsController@markAsRead')->name('markread');
    Route::post('/deleteqmsAudit','qmsauditController@destroy')->name('deleteqmsAudit');
    Route::post('/delete_customer_review','CustomerReviewController@destroy')->name('delete_customer_review');
    Route::post('/delete_maintain_rec','MaintainRecController@destroy')->name('delete_m_r');

    Route::get('/check-customer-number','CustomerController@check_customer_number')->name('check_customer_number');
    Route::get('/check-order-number','AddUsersController@check_order_number')->name('check_order_number');

    Route::get('/organization-structure','AdminController@organization_images')->name('organization-structure');
    Route::post('/organization-structure','AdminController@organization_structure')->name('organization-structure');

    // delete
    Route::post('/addRequirementadmin', 'AddUsersController@addreq')->name('addRequirementadmin')->middleware(['auth']);

    Route::post('/deleteRequirementadmin', 'AddUsersController@destroyreq')->name('deleteRequirementadmin')->middleware(['auth']);
    Route::post('/deleteNonConfrm', 'AddUsersController@deleteNonConfrm')->name('deleteNonConfrm');
    Route::post('/deletenonconfimity', 'nonConfromFormController@destroy')->name('deletenonconfimity');
    Route::post('/deletecustomeradmin', 'AddUsersController@deletecustomeradmin')->name('deletecustomeradmin');
    Route::get('/deleteRequirement/{id}','RequiremntController@destroy1')->name('deleteRequirements');
    Route::post('/deleteRequirement','RequiremntController@destroy')->name('deleteRequirement');
    Route::post('/deleteProcess','auditController@destroy')->name('deleteProcess');
    Route::post('/deleteInterested','interestedController@destroy')->name('deleteInterested');
    Route::post('/deleteSupplier','SupplierController@destroy')->name('deleteSupplier');
    Route::post('/deletemgtreview','MgtreviewController@destroy')->name('deletemgtreview');
    Route::post('/deleteRisk','AccidentRiskController@destroy')->name('deleteRisk');
    Route::post('/deleteWork','WorkInstructionController@destroy')->name('deleteWork');

    // details
    Route::post('/uploadimg', 'ImagesUploadController@index')->name('uploadimg');
    Route::post('/removesales', 'ImagesUploadController@removesales')->name('removesales');
    Route::post('/purchprocess', 'ImagesUploadController@purchprocess')->name('purchprocess');
    Route::post('/servicingprocess', 'ImagesUploadController@servicingprocess')->name('servicingprocess');
    Route::post('/comptprocess', 'ImagesUploadController@comptprocess')->name('comptprocess');
    Route::post('/processinteraction', 'ImagesUploadController@processinteraction')->name('processinteraction');
    Route::post('/mgmtorg', 'ImagesUploadController@mgmtorg')->name('mgmtorg');

    //User msgs
    Route::post('/send_msg_to_admin', 'UserMsgController@send_msg_to_admin');
    Route::get('/faq', 'UserInfoController@the_faqs');
    Route::get('/explainer_videos', 'UserInfoController@explainer_videos');
    
    Route::get('/quick_links', 'UserInfoController@quick_links');
    Route::post('/remove_iso', 'UserInfoController@remove_iso');
    Route::get('/users_messages', 'UserMsgController@users_messages');
    Route::post('/upd_msg_status', 'UserMsgController@upd_msg_status');
    Route::post('/get_user_inbox_count', 'UserMsgController@get_user_inbox_count');
    Route::post('/get_admin_inbox_count', 'UserMsgController@get_admin_inbox_count')->name('get_admin_inbox_count');
    //for users downloads
    Route::get('/userDownload', 'UserInfoController@userDownload')->name("user.download");
    Route::get('/downloads/userfilter', 'UserInfoController@userfilter')->name('downloads.userfilter');
    Route::post('/get-data', 'UserInfoController@getDownloadUser')->name("user.get-data");
    Route::get('/viewDownload', 'UserInfoController@viewDownload')->name("user.viewdownload");
    
    //Check if empolyee already exist for current user by assad yaqoob 6 july 2022

    Route::get('/check-emp-number', 'AddUsersController@checkEmpNumber');


    
});


/*************** Auth middleware implemented on these urls end ***************/

/*************** Customer View start ***************/
/*************** These are just layouts - not functional ***************/

Route::get('/customer/add', function () {
    return view('dashboard.customer.add');
});
Route::get('/customer/edit', function () {
    return view('dashboard.customer.edit');
});
Route::get('/customer/planes', function () {
    return view('dashboard.customer.planes');
});


/*************** Agent View ***************/


Route::get('/agent', function () {
    return view('dashboard.agent.index');
});
Route::get('/agent/add', function () {
    return view('dashboard.agent.add');
});
Route::get('/agent/edit', function () {
    return view('dashboard.agent.edit');
});



/*************** Customer View end ***************/

/*************** One time script for easily changes to running project start ***************/
Route::group(['middleware' => ['auth','admin']], function () 
{
    Route::get('/cache-clear', function() { Artisan::call('cache:clear'); dd("Cache is cleared"); });
    Route::get('/config-clear', function() { Artisan::call('config:clear'); dd("Config is cleared"); });

    //Add cv column to tbl_employees table
    Route::get('addCvColumnToEmployeesTable','OneTimeScriptController@addCvColumnToEmployeesTable');
    //Add attach_evidence column to tbl_audit table
    Route::get('addAttachEvidenceColumnToAuditTable','OneTimeScriptController@addAttachEvidenceColumnToAuditTable');
    //Add attach_evidence & any_issues column to tbl_qmsaudit table
    Route::get('addAttEviAndIssuesColToQmsAuditTbl','OneTimeScriptController@addAttEviAndIssuesColToQmsAuditTbl');
    //Add audit_support column to users table
    Route::get('addAuditReportColToUsersTbl','OneTimeScriptController@addAuditReportColToUsersTbl');
    
    //Hash generator for custom emails
    Route::get('pwd/{secret}/{email}',function ($secret,$email)
    {
        if ($secret == 89686)
        {
            $password = \Illuminate\Support\Facades\Hash::make('password');
            $result = \App\User::where('email',$email)->update([
                'password' =>  $password
            ]);

            return $result ? dd('Password updated') : dd('Not updated');
        }
        else
        {
            dd('Incorrect secret');
        }

    });

   

});


Route::get('test' , function(){
    $userIdToExclude = 1011;
    $user = User::where('last_login', '<=', Carbon::now()->subDays(90))
    ->where('id', '!=', $userIdToExclude)
    // ->get(); 
    ->pluck("id", "email");
    dd($user);   
    foreach($user as $u){
        $lastLogin = Carbon::parse($u->last_login);
        $totalDays = now()->diffInDays($lastLogin);
        $toEmailAddress = "info@isoonline.com";
        $clientName = $u->name;
        $clientEmail = $u->email;
            if ($totalDays == 90 || $totalDays == 180 || $totalDays == 300) {
                if($totalDays == 90){
                    Notification::route('mail', $toEmailAddress)->notify(new ThreeMonthNotification($clientName, $totalDays, $clientEmail));
                }elseif($totalDays == 180){
                    Notification::route('mail', $toEmailAddress)->notify(new SixMonthNotification($clientName, $totalDays, $clientEmail));
                }elseif($totalDays == 300){
                Notification::route('mail', $toEmailAddress)->notify(new TenMonthNotification($clientName, $totalDays, $clientEmail));
                }else{
                    print_r("No email template Found");
                }
                $randomBytes = random_bytes(4); 
                $randomInt = unpack('L', $randomBytes)[1];
                DB::table('send_notification')->insert([
                    'title' => 'You haven`t signed in for the last ' . $totalDays . ' Days',
                    'send_by' => 1011,
                    'send_to' => $u->id,
                    'unique_id' => intval(microtime(true) + $randomInt),
                    'total_days' => $totalDays,
                ]);
                echo "Email Send Successfully " . $totalDays . " <br>";
            } else {
                print_r("Days are not matching to 90, 180 or 300. Days are " . $totalDays);
                echo "<br>";
            }
    }
});


// send an email for a specific user

// Route::get('test', function(){
//     $userid = 11664; // Enter the id of a user
//     $user  = User::where('id', $userid)->first();

//     $threeMonth = 90;
//     $sixMonth = 180;
//     $tenMonth = 300;
//     $toEmailAddress = "info@isoonline.com";
//     $clientName = $user['name'];
//     $clientEmail = $user['email'];

//     // Send Emails
//     Notification::route('mail', $toEmailAddress)->notify(new ThreeMonthNotification($clientName, $threeMonth, $clientEmail));
//     Notification::route('mail', $toEmailAddress)->notify(new SixMonthNotification($clientName, $sixMonth, $clientEmail));
//     Notification::route('mail', $toEmailAddress)->notify(new TenMonthNotification($clientName, $tenMonth, $clientEmail));

//     // sending email on MYISO online
//     $randomBytes = random_bytes(4); 
//     $randomInt = unpack('L', $randomBytes)[1];
//     DB::table('send_notification')->insert([
//         'title' => 'You haven`t signed in for the last ' . $threeMonth . ' Days',
//         'send_by' => 1011,
//         'send_to' => $userid,
//         'unique_id' => intval(microtime(true) + $randomInt),
//         'total_days' => $threeMonth,
//     ]);
//     echo "Email Send Successfully " . $threeMonth . " <br>";

//     $randomBytes = random_bytes(4); 
//     $randomInt = unpack('L', $randomBytes)[1];
//     DB::table('send_notification')->insert([
//         'title' => 'You haven`t signed in for the last ' . $sixMonth . ' Days',
//         'send_by' => 1011,
//         'send_to' => $userid,
//         'unique_id' => intval(microtime(true) + $randomInt),
//         'total_days' => $sixMonth,
//     ]);
//     echo "Email Send Successfully " . $sixMonth . " <br>";
    
//     $randomBytes = random_bytes(4); 
//     $randomInt = unpack('L', $randomBytes)[1];
//     DB::table('send_notification')->insert([
//         'title' => 'You haven`t signed in for the last ' . $tenMonth . ' Days',
//         'send_by' => 1011,
//         'send_to' => $userid,
//         'unique_id' => intval(microtime(true) + $randomInt),
//         'total_days' => $tenMonth,
//     ]);
//     echo "Email Send Successfully " . $tenMonth . " <br>";

// });


// for sending notifications who haven`t login for the last 300 days

// Route::get('test', function(){
//     $userIdToExclude = 1011;
//     $user = User::where('last_login', '<=', Carbon::now()->subDays(90))
//     ->where('id', '!=', $userIdToExclude)
//     ->get();    
//     foreach($user as $u){
//         $lastLogin = Carbon::parse($u->last_login);
//         $totalDays = now()->diffInDays($lastLogin);
//         $toEmailAddress = "info@isoonline.com";
//         $clientName = $u->name;
//         $clientEmail = $u->email;
//             if ($totalDays > 180 && $totalDays < 300) {
//                 // Notification::route('mail', $toEmailAddress)->notify(new TenMonthNotification($clientName, $totalDays, $clientEmail));
//                 $randomBytes = random_bytes(4); 
//                 $randomInt = unpack('L', $randomBytes)[1];
//                 DB::table('send_notification')->insert([
//                     'title' => 'You haven`t signed in for the last ' . $totalDays . ' Days',
//                     'send_by' => 1011,
//                     'send_to' => $u->id,
//                     'unique_id' => intval(microtime(true) + $randomInt),
//                     'total_days' => $totalDays,
//                 ]);
//                 echo "Email Send Successfully " . $totalDays . " <br>";
//             } else {
//                 print_r("Days are not matching to 90, 180 or 300. Days are " . $totalDays);
//                 echo "<br>";
//             }
//     }
// });


// Mail Routes for generating emails for 3, 6 and 10 months
Route::get('three-month-email', function(){
    return view('mails.threeMonthEmail');
});

Route::get('six-month-email', function(){
    return view('mails.sixMonthEmail');
});

Route::get('ten-month-email', function(){
    return view('mails.tenMonthEmail');
});
/*************** One time script for easily changes to running project end ***************/