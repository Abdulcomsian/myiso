<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\RequiremntController;
use App\requirement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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


Route::get('/clear', function() {
Artisan::call('cache:clear');
    return "Cache is cleared";
});
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/forgot', function () {
    return view('auth.forgot');
});
// Route::POST('/loginroute','Auth.LoginController')->name('loginroute');
Route::get('/logout', function () {
    Auth::logout();
    $notification = [
        'message' => 'Logout Successfully.!',
        'alert-type' => 'success'
    ];
    return redirect('/')->with($notification);

});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home')->middleware(['auth','usermiddle']);
Route::get('/ajax/products', 'ProductController@fetchAllProducts')->name('ajax-products');
Route::get('/ajax/users', 'UserController@fetchAllUsers')->name('ajax-users');
Route::get('user-profile/{id}', 'ShowProfile');
/*Route::resource('products', 'ProductController');
Route::resource('users', 'UserController');*/
Route::resources([
    'products' => 'ProductController',
    'users' => 'UserController',

]);

/*************** Customer View ***************/
Route::get('/customer', function () {
    return view('dashboard.customer.index')->middleware(['auth','usermiddle']);
});
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
/*********** Document Required ***********/
// Route::get('/document_required', function () {
//     return view('dashboard.document');
// });
Route::get('/document_required', 'WorkInstructionController@doc_req');
/*********** Manual & Policies **********
Route::get('/quality_manual', function () {
    return view('dashboard.mannual_policy.quality_manual');
});*/

Route::get('/quality_manual', 'AddUsersController@quality_manual');

Route::get('/quality_policy', function () {
    return view('dashboard.mannual_policy.quality_policy');
});
Route::get('/enviornment_policy', function () {
    return view('dashboard.mannual_policy.enviornment_policy');
});
Route::get('/health_policy', function () {
    return view('dashboard.mannual_policy.health_safety_policy');
});

Route::get('/management_organogram','ImagesUploadController@management_organogram');
/*********** Prcesses ***********/
Route::get('/sale_processes','ImagesUploadController@sale_process');
Route::get('/purchasing_processes','ImagesUploadController@purchasing_process');
Route::get('/servicing_contract','ImagesUploadController@servicing_contract');
Route::get('/competency_process','ImagesUploadController@competency_process');



Route::get('/process_interaction','ImagesUploadController@process_interaction'); 

/*********** Procedure ***********/
Route::get('/documented_information', function () {
    return view('dashboard.procedure.documented_information');
});
Route::get('/corrective_action', function () {
    return view('dashboard.procedure.corective_action');
});
Route::get('/management_review', function () {
    return view('dashboard.procedure.management_review');
});
Route::get('/monitoring_measure', function () {
    return view('dashboard.procedure.monitoring_measure');
});
Route::get('/auidt', function () {
    return view('dashboard.procedure.audits');
});
Route::get('/audit', function () {
    return view('admin.adminform_records.audit');
});
/*********** Form & Records ***********/
Route::get('/requirements_aspect','RequiremntController@index')->middleware(['auth','usermiddle']);
Route::get('/process_audit','auditController@index')->middleware(['auth','usermiddle']);
Route::get('/interesting_parties','interestedController@index');
Route::get('/chemical_control','chemicalController@index');
Route::post('/chemical_control_delete','chemicalController@destroy_chemical')->middleware(['auth','usermiddle']);
Route::get('/qms_audit','qmsauditController@index')->middleware(['auth','usermiddle']);
Route::get('/non_confromities','nonConfromFormController@index')->middleware(['auth','usermiddle']);


Route::POST('/get_customer_name_by_id', 'nonConfromFormController@get_customer_name_by_id');

Route::get('/customer','CustomerController@index')->middleware(['auth','usermiddle']);
Route::get('/customer/check','CustomerController@check_customer')->name('checkcustomer');
Route::get('/customer_review', 'CustomerReviewController@index')->middleware(['auth','usermiddle']);
Route::get('/supplier', 'SupplierController@index')->middleware(['auth','usermiddle']);
Route::get('/calibration_record','CalibrationController@index')->middleware(['auth','usermiddle']);
Route::post('/calibration_delete','CalibrationController@destroy')->middleware(['auth','usermiddle']);
Route::get('/employess', 'EmployeeController@index')->middleware(['auth','usermiddle']);
Route::get('/add_management_review', 'MgtreviewController@index')->middleware(['auth','usermiddle']);
Route::get('/maintance_record','MaintainRecController@index')->middleware(['auth','usermiddle']);
Route::get('/accident_risk','AccidentRiskController@index')->middleware(['auth','usermiddle']);
Route::get('/risk_assessment','AssessmentController@index')->middleware(['auth','usermiddle']);
Route::post('/employess-delete', 'EmployeeController@destroy')->name('employess-delete');
Route::post('/update-employes-skill', 'EmployeeController@updateempSkills')->name('update-employes-skill');
Route::post('/update-employes-training', 'EmployeeController@updateemptraining')->name('update-employes-training');
Route::post('/delete_assesment','AssessmentController@destroy')->name('delete_assesment');



Route::get('/work_instruction', 'WorkInstructionController@index')->middleware(['auth','usermiddle']);
Route::get('/userprofile', function () {
    return view('dashboard.procedure.userprofile');
})->name('userprofile')->middleware(['auth','usermiddle']);


Route::get('/view_work', function () {
    return view('dashboard.view_work_instruction.view_work_instruction');
});
/*Route::get('/contact_us', function () {
    return view('dashboard.contact_us');
});*/
Route::get('/contact_us', 'UserMsgController@index');
/**************POST Methods are Down*****************/
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
Route::get('/inboxmessage','SendNotificationsController@index')->name('inboxmessage');

Route::post('/deleteqmsAudit','qmsauditController@destroy')->name('deleteqmsAudit');

Route::post('/delete_customer_review','CustomerReviewController@destroy')->name('delete_customer_review');

Route::post('/delete_maintain_rec','MaintainRecController@destroy')->name('delete_m_r');

Route::get('/check-customer-number','CustomerController@check_customer_number')->name('check_customer_number');
Route::get('/check-order-number','AddUsersController@check_order_number')->name('check_order_number');


// admin routesf 
// Route::group(['middleware' => ['auth', 'admin']], function () {
    
// });
Route::get('/admin', 'AdminController@index')->middleware(['auth','admin']);
    Route::get('/add_user', function () {
        return view('admin.dashboard.admin.add_user');
    })->middleware(['auth','admin']);
    Route::get('/organization-structure','AdminController@organization_images')->name('organization-structure');

    Route::post('/organization-structure','AdminController@organization_structure')->name('organization-structure');
    Route::get('/view_user', 'AddUsersController@index')->middleware(['auth','admin']);
    Route::get('/edit_user/{id}', function () {
        return view('admin.dashboard.admin.edit_user');
    });
    Route::post('/add_user', 'AddUsersController@store')->name('add_user')->middleware(['auth','admin']);
    
    Route::post('/deleteuserd', 'AddUsersController@destroy')->name('deleteuserd')->middleware(['auth','admin']);
    Route::post('/updateuserinfo', 'AddUsersController@update')->name('updateuserinfo')->middleware(['auth','admin']);
    // Route::post('/updateuserprofile', 'AddUsersController@update')->name('updateuserprofile'); 

    // details
    Route::GET('/requiremntCheck/{userid}', 'AddUsersController@requirementcheck');
    Route::GET('/ProcessCheck/{userid}', 'AddUsersController@ProcessCheck'); 
    Route::GET('/AuditsCheck/{userid}', 'AddUsersController@AuditsCheck'); 
    Route::GET('/nonConformCheck/{userid}', 'AddUsersController@nonConformCheck');
    Route::GET('/customerCheck/{userid}', 'AddUsersController@customerCheck'); 
    Route::GET('/customerReviewad/{userid}', 'AddUsersController@customerReviewad'); 
    Route::GET('/supplierCheck/{userid}', 'AddUsersController@supplierCheck'); 
    Route::GET('/calibrationcheck/{userid}', 'AddUsersController@calibrationcheck'); 
    Route::GET('/chemicalcheck/{userid}', 'AddUsersController@chemicalcheck')->name("chemicalcheck");
    Route::GET('/EmployeCheck/{userid}', 'AddUsersController@EmployeCheck'); 
    Route::GET('/managementCheck/{userid}', 'AddUsersController@managementCheck'); 
    Route::GET('/maintainRecCheck/{userid}', 'AddUsersController@maintainRecCheck'); 
    Route::GET('/AccidentCheck/{userid}', 'AddUsersController@AccidentCheck'); 
    Route::GET('/riskAssesmntCheck/{userid}', 'AddUsersController@riskAssesmntCheck'); 
    Route::GET('/workinstructionCheck/{userid}', 'AddUsersController@workinstructionCheck'); 
    Route::GET('/send_notifications', 'AddUsersController@send_notifications')->middleware(['auth','admin']);
    Route::GET('/receive_notifications', 'AddUsersController@receive_notifications')->middleware(['auth','admin']); 
    Route::GET('/send_message', 'AddUsersController@send_message')->middleware(['auth','admin']);


    Route::POST('/add_faq', 'AddUsersController@add_faq')->middleware(['auth','admin']);
    Route::POST('/add_faq_cate', 'AddUsersController@add_faq_cate')->middleware(['auth','admin']); 
    Route::GET('/faq_edit/{id}', 'AddUsersController@faq_edit')->middleware(['auth','admin']);
    Route::POST('/faq_update/{id}', 'AddUsersController@faq_update')->middleware(['auth','admin']); 
    Route::POST('/faq_delete/{id}', 'AddUsersController@faq_delete')->middleware(['auth','admin']); 
    Route::GET('/all_faqs', 'AddUsersController@all_faqs')->middleware(['auth','admin']); 
    Route::POST('/cat_delete/{id}', 'AddUsersController@cat_delete')->middleware(['auth','admin']); 


    Route::POST('/add_video', 'AddUsersController@add_video')->middleware(['auth','admin']);
    Route::GET('/video_edit/{id}', 'AddUsersController@video_edit')->middleware(['auth','admin']);
    Route::POST('/video_update/{id}', 'AddUsersController@video_update')->middleware(['auth','admin']); 
    Route::POST('/video_delete/{id}', 'AddUsersController@video_delete')->middleware(['auth','admin']); 
    Route::GET('/all_videos', 'AddUsersController@all_videos')->middleware(['auth','admin']); 


    Route::POST('/add_quick_link', 'AddUsersController@add_quick_link')->middleware(['auth','admin']);
	Route::POST('/add_quicklink_cate', 'AddUsersController@add_quicklink_cate')->middleware(['auth','admin']); 
    Route::GET('/quick_link_edit/{id}', 'AddUsersController@quick_link_edit')->middleware(['auth','admin']);
    Route::POST('/quick_link_update/{id}', 'AddUsersController@quick_link_update')->middleware(['auth','admin']); 
    Route::POST('/quick_link_delete/{id}', 'AddUsersController@quick_link_delete')->middleware(['auth','admin']); 
    Route::GET('/all_quick_links', 'AddUsersController@all_quick_links')->middleware(['auth','admin']); 
    Route::POST('quick_link_category_delete', 'AddUsersController@quick_link_category_delete')->middleware(['auth','admin']);
    
    
    
    Route::GET('/interested_parties/{id}', 'AddUsersController@interested_parties')->middleware(['auth','admin']);

    

    

    // edit

    Route::post('/updaterequiremntadmin', 'AddUsersController@updateadmin')->name('updaterequiremntadmin')->middleware(['auth','admin']);
    Route::post('/auditupdateadmin', 'AddUsersController@updateauditadmin')->name('auditupdateadmin')->middleware(['auth','admin']);
    Route::post('/auditsaveadmin','AddUsersController@storeadminaudit')->name('auditsaveadmin')->middleware(['auth','admin']);
    
    // delete 
    Route::post('/deleteRequirementadmin', 'AddUsersController@destroyreq')->name('deleteRequirementadmin')->middleware(['auth']);
    Route::post('/addRequirementadmin', 'AddUsersController@addreq')->name('addRequirementadmin')->middleware(['auth']);
    Route::post('/deleteauditadmin', 'AddUsersController@destroyaudit')->name('deleteauditadmin')->middleware(['auth','admin']); 
    Route::post('/auditdeleter', 'AddUsersController@auditdeleter')->name('auditdeleter')->middleware(['auth','admin']); 
    
    Route::post('/deleteNonConfrm', 'AddUsersController@deleteNonConfrm')->name('deleteNonConfrm');
    Route::post('/deletenonconfimity', 'nonConfromFormController@destroy')->name('deletenonconfimity');
    
    Route::post('/deletecustomeradmin', 'AddUsersController@deletecustomeradmin')->name('deletecustomeradmin');
    Route::post('/deleteCustomerRivewAdmin', 'AddUsersController@deleteCustomerRivewAdmin')->name('deleteCustomerRivewAdmin')->middleware(['auth','admin']); 
    Route::post('/deleteSupplierAdmin', 'AddUsersController@deleteSupplierAdmin')->name('deleteSupplierAdmin')->middleware(['auth','admin']);
    Route::post('/deletecaliberinfo', 'AddUsersController@deletecaliberinfo')->name('deletecaliberinfo')->middleware(['auth']);
    Route::post('/deleteEmployeeadmin', 'AddUsersController@deleteEmployeeadmin')->name('deleteEmployeeadmin')->middleware(['auth','admin']);
    Route::post('/deleteEmployeeskill', 'AddUsersController@deleteEmployeeskill')->name('deleteEmployeeskill')->middleware(['auth','admin']);
    Route::post('/deletemgtreviewadmin', 'AddUsersController@deletemgtreviewadmin')->name('deletemgtreviewadmin')->middleware(['auth','admin']);
    Route::post('/deletemaintanceRecAdmin', 'AddUsersController@deletemaintanceRecAdmin')->name('deletemaintanceRecAdmin')->middleware(['auth','admin']);
    Route::post('/deleteRiskadmin', 'AddUsersController@deleteRiskadmin')->name('deleteRiskadmin')->middleware(['auth','admin']);
    Route::post('/deleteAssesmnetadmin', 'AddUsersController@deleteAssesmnetadmin')->name('deleteAssesmnetadmin')->middleware(['auth','admin']);
    Route::post('/deleteWorkadmin', 'AddUsersController@deleteWorkadmin')->name('deleteWorkadmin')->middleware(['auth','admin']);
    Route::post('/sendNotifications', 'AddUsersController@sendNotifications')->name('sendNotifications')->middleware(['auth','admin']);
    Route::post('/deleteNotifications', 'AddUsersController@deleteNotifications')->name('deleteNotifications')->middleware(['auth','admin']);
     Route::post('/deleteMessage', 'AddUsersController@deleteMessage')->name('deleteMessage')->middleware(['auth','admin']);
    Route::post('/deleteChemical', 'AddUsersController@deletechemicaladmin')->name('deletechemicaladmin')->middleware(['auth','admin']);
 Route::post('/deleteChemical2', 'AddUsersController@deleteChemical2')->name('deleteChemical2')->middleware(['auth','admin']);
    

    
    
    
    


    
    
    

    


    



    











// delete details





// delete queries
Route::get('/deleteRequirement/{id}','RequiremntController@destroy1')->name('deleteRequirements');
Route::post('/deleteRequirement','RequiremntController@destroy')->name('deleteRequirement');
Route::post('/deleteProcess','auditController@destroy')->name('deleteProcess');
Route::post('/deleteInterested','interestedController@destroy')->name('deleteInterested');
Route::post('/deleteSupplier','SupplierController@destroy')->name('deleteSupplier');
Route::post('/deletemgtreview','MgtreviewController@destroy')->name('deletemgtreview');
Route::post('/deleteRisk','AccidentRiskController@destroy')->name('deleteRisk');
Route::post('/deleteWork','WorkInstructionController@destroy')->name('deleteWork');
// admindelete rout



















// nonConfromForm




   // details
    Route::post('/uploadimg', 'ImagesUploadController@index')->name('uploadimg');
    Route::post('/removesales', 'ImagesUploadController@removesales')->name('removesales');
    Route::post('/purchprocess', 'ImagesUploadController@purchprocess')->name('purchprocess');
    Route::post('/servicingprocess', 'ImagesUploadController@servicingprocess')->name('servicingprocess');
    Route::post('/comptprocess', 'ImagesUploadController@comptprocess')->name('comptprocess');
    Route::post('/processinteraction', 'ImagesUploadController@processinteraction')->name('processinteraction');
    Route::post('/mgmtorg', 'ImagesUploadController@mgmtorg')->name('mgmtorg');


//User msgs
Route::POST('/send_msg_to_admin', 'UserMsgController@send_msg_to_admin');



Route::get('/faq', 'UserInfoController@the_faqs');
Route::get('/explainer_videos', 'UserInfoController@explainer_videos');
Route::get('/quick_links', 'UserInfoController@quick_links');



Route::post('/remove_iso', 'UserInfoController@remove_iso');


Route::get('/users_messages', 'UserMsgController@users_messages');
Route::post('/upd_msg_status', 'UserMsgController@upd_msg_status');
Route::post('/get_user_inbox_count', 'UserMsgController@get_user_inbox_count');
Route::post('/get_admin_inbox_count', 'UserMsgController@get_admin_inbox_count');


Route::get('/test-email',function(){
   dump('Here in web'); 
   
   Mail::send([], [], function ($message) { 
    $message->to('shanipasrooria@gmail.com', 'Tutorials Point')
       ->subject('subject') 
       ->setBody('some body', 'text/html'); 
});
      echo "Basic Email Sent. Check your inbox.";
});

