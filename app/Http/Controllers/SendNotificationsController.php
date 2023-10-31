<?php

namespace App\Http\Controllers;

use App\SendNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\messageNotification;
use App\AddUsers;
use App\User;
use DB;

class SendNotificationsController extends Controller
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
        $message_info=SendNotifications::join('users', 'users.id','=','send_notification.send_by')
        ->select('send_notification.*', 'users.name', 'users.company_name')
        ->where('send_notification.send_to',$userid)
        ->groupby('send_notification.unique_id')
        ->orderBy('send_notification.updated_at', 'desc')
        ->get();
        return view('dashboard.form_records.inboxmessage',compact('message_info'));
    }


    public function oldNotifications(){
        $userid=Auth::user()->id;
        $message_info=SendNotifications::orderBy('send_notification.id', 'desc')->get();
        return view('dashboard.form_records.inboxmessage-old',compact('message_info'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUserMessage(Request $request)
    {

        if($request->ajax())
        {
            //  dd($request->start_date);
             
             //&& $request->month
            if($request->type=="month")
            {
                $start_date = date("Y-m-d", strtotime($request->start_date));
                $end_date =  date('Y-m-d', strtotime("+1 day", strtotime($request->end_date)));
              //  $end_date = date("Y-m-d", strtotime($request->end_date));
                //$end_date = date("YYYY-mm-dd",$request->end_date);
               // dd($end_date);
                if(isset($request->filter_by_certificate)){
                  
                    if($request->filter_by_certificate=="iso9001_certificate"){  
                        $users=AddUsers::where([["last_login",">=", $start_date],["last_login","<=", $end_date]])->where("iso9001_certificate","!=", NULL)->where("iso14001_certificate", NULL)->where("iso45001_certificate",NULL)->get();
                    }else if($request->filter_by_certificate=="iso14001_certificate"){
                        $users=AddUsers::where([["last_login",">=", $start_date],["last_login","<=", $end_date]])->where("iso14001_certificate","!=", NULL)->where("iso9001_certificate", NULL)->where("iso45001_certificate",NULL)->get();
                    }else if($request->filter_by_certificate=="iso45001_certificate"){
                        $users=AddUsers::where([["last_login",">=", $start_date],["last_login","<=", $end_date]])->where("iso45001_certificate","!=", NULL)->where("iso9001_certificate", NULL)->where("iso14001_certificate",NULL)->get();
                    }else if($request->filter_by_certificate=="all"){
                        $users = AddUsers::whereBetween('last_login',[$start_date,$end_date])
                            ->where(function($q)
                        {
                          $q->orWhereNotNull("iso9001_certificate")->orWhereNotNull("iso14001_certificate")->orWhereNotNull("iso45001_certificate");
                        })->get();
//                        $users=AddUsers::where([["last_login",">=", $start_date],["last_login","<=", $end_date]])->whereNotNull("iso9001_certificate")->orWhereNotNull("iso14001_certificate")->orWhereNotNull("iso45001_certificate")->get();
                    }else if($request->filter_by_certificate=="ims"){
                        $users = AddUsers::whereBetween('last_login',[$start_date,$end_date])
                            ->where(function($q)
                            {
                                $q->whereNotNull("iso9001_certificate")->whereNotNull("iso14001_certificate")->whereNotNull("iso45001_certificate");
                            })->get();
//                        $users=AddUsers::where([["last_login",">=", $start_date],["last_login","<=", $end_date]])->where("iso45001_certificate","!=", NULL)->where("iso9001_certificate","!=", NULL)->where("iso14001_certificate","!=", NULL)->get();
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
            // $users=AddUsers::where('role_type','user')->get();
            $users=AddUsers::get();
            $adminmessage=SendNotifications::join('users','users.id','=','send_notification.send_to')
            ->select('send_notification.id as notification_id','send_notification.*','users.*')
            ->where('admin_delete',false)
            ->orderby('notification_id','desc')
            ->get();
            return view('dashboard.form_records.createMessageUser',compact('users','adminmessage'));
        }
        
        // return view('dashboard.form_records.createMessageUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeNotification(Request $request)
    {
        $data = [];
        $admin_id = 1011;

        if ($request->file('attachment')) {
            $imagePath = $request->file('attachment');
            $imageName = uniqid() . "." . $request->file('attachment')->extension();
            $path = $request->file('attachment')->storeAs('uploads/user', $imageName, 'public');
            $request->file('attachment')->move(public_path('uploads/user'), $imageName);
            $data['attachement'] = $path;
        }
        $user_id = Auth::user()->id;

        $data['title']=$request->input('title');
        $data['message']=$request->input('message');
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['send_by'] = $user_id;
        // generating a random unique Id
        $randomBytes = random_bytes(4); 
        $randomInt = unpack('L', $randomBytes)[1];
        $data['unique_id'] = intval(microtime(true) + $randomInt);
        $data['send_to'] = $admin_id;
        // dd($data['send_to']);

        // Storing data into Database
        SendNotifications::create($data);
        // sending Notification
        $user = User::where('id', $admin_id)->first();
        $senderName = Auth::user()->name;
        $notificationMessage = new messageNotification($senderName);
        $user->notify($notificationMessage);

        // DB::table('users_messages')->where('id', $request->input('replied'))->update(['replied' => 1]);
        return redirect()->back()->with('success', 'Your message has been Sent');
    }

    public function sentNotifications(){
        $user_id = Auth::user()->id;
        $users = SendNotifications::join('users','users.id','=','send_notification.send_to')
        ->select('send_notification.*', 'users.name', 'users.company_name')
        ->where('send_notification.send_by', $user_id)
        ->groupBy('send_notification.unique_id')
        ->orderby('send_notification.updated_at', 'desc')
        ->get();
        return view('dashboard.form_records.sentMessages', compact('users'));
    }

    public function individualMessageUser(){
        $messageId = $_GET['id'];
        $message_information = SendNotifications::join('users', 'users.id','=','send_notification.send_by')
        ->where('unique_id', $messageId)
        ->orderby('send_notification.id', 'desc')
        ->select('send_notification.*', 'users.name')
        ->get();

        $user_id = Auth::user()->id;
        $parent_message_id = SendNotifications::where('unique_id', $messageId)
        ->where('send_by', $user_id)
        ->first(['id']);

        return view('dashboard.form_records.individual-message-user', compact('message_information', 'parent_message_id'));
    }

    public function storeReplyMessageUser(Request $request){
        $user_id = Auth::user()->id;
        $receiver = $request->input('receiver');
        $sender = $request->input('sender');
        $parentId = $request->input('parentId');
        $parentIdArray = json_decode($parentId, true);
        if (is_array($parentIdArray) && isset($parentIdArray['id'])) {
            $id = $parentIdArray['id'];
        }
        $reply = new SendNotifications;
        $reply->title = $request->input('title');
        $reply->message = $request->input('replyMessage');

        if($receiver == $user_id){
            $reply->send_by = $user_id;
            $reply->send_to = $sender;
        }else{
            $reply->send_to = $receiver;
            $reply->send_by = $user_id;
        }

        if ($request->hasFile('attachment')) {
            $imagePath = $request->file('attachment');
            $imageName = uniqid() . "." .$imagePath->extension();
            $path = $request->file('attachment')->storeAs('uploads/user', $imageName, 'public');
            $request->file('attachment')->move(public_path('uploads/user'), $imageName);
            $reply->attachement = $path;
        }

        $reply->created_at = date('Y-m-d H:i:s');
        $reply->unique_id = $request->input('messageId');
        $reply->save();
        // dd($id);
        if(!empty($id)){
            SendNotifications::where('id', $id)->update(['status'=>0]);
        }
        return redirect()->back();
    }
    
    public function markAsRead(Request $request) {
        $user_id = Auth::user()->id;
        $item_id = $request->input('item_id');
        SendNotifications::where('unique_id', $item_id)->update(['status' => 1]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SendNotifications  $sendNotifications
     * @return \Illuminate\Http\Response
     */
    public function show(SendNotifications $sendNotifications)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SendNotifications  $sendNotifications
     * @return \Illuminate\Http\Response
     */
    public function edit(SendNotifications $sendNotifications)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SendNotifications  $sendNotifications
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SendNotifications $sendNotifications)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SendNotifications  $sendNotifications
     * @return \Illuminate\Http\Response
     */
    public function destroy(SendNotifications $sendNotifications)
    {
        //
    }
}
