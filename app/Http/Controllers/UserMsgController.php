<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use App\Events\MyEvent;
use App\Models\Notification;

class UserMsgController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$user = Auth::user();

      return view('dashboard.contact_us',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function send_msg_to_admin(Request $request){
        $path='';
        if ($request->file('attachment')) {
			   $request->validate([
            'attachment' => 'required|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf,docx,doc,mp4,mp3|max:8048'
            ]);
            $imagePath = $request->file('attachment');
            $imageName = uniqid().".".$request->file('attachment')->extension();
            $path = $request->file('attachment')->storeAs('uploads/user', $imageName, 'public');
          $request->file('attachment')->move(public_path('uploads/user'), $imageName);
            
        }		
	$insert = DB::table('users_messages')->insert(
    array('name' => $request['name'],
          'company' => $request['company'],
		  'user_id' => $request['user_id'],
		  'subject' => $request['subject'],
          'email' => $request['email'],
          'comments' => $request['comments'],
		  'attachement' => $path,
		  'created_at' => now(),
        )
	);
  event(new MyEvent('bbb'));
	session()->flash('msg', '<div class="alert alert-success alert-dismissible">Message sent successfully. &nbsp; <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
    return redirect()->back();
		
	}
	
	public function users_messages()
    {
		//$user = Auth::user();
		//dd($user);
        $userid=Auth::user()->id;
		
        $message_info = DB::table('users_messages')->where('user_id',$userid)->orderBy('id', 'desc')->get();
        return view('dashboard.users_messages',compact('message_info'));
    }

 public function upd_msg_status(Request $request){
	 $id = $request['id'];
	 $user_type = $request['user_type'];
	 
	 if($user_type == 'admin'){
		 DB::table('users_messages')->where('id',$id)->update(['status' => 1]);
	 }elseif($user_type == 'user'){
		 DB::table('send_notification')->where('id',$id)->update(['status' => 1]);
	 }else{
		 echo 'Error: Something unexpected occured, please try again later!';
	 }
	 
 }
 
 
  public function get_user_inbox_count(Request $request){
    $id=Auth::user()->id;
      $count = DB::table('send_notification')->where(['status' => 0, 'send_to'=>$id])->groupBy('unique_id')->count();
      echo $count;    
  }
  public function get_admin_inbox_count(Request $request){
    $id=Auth::user()->id;
    $count = DB::table('send_notification')->where(['status' => 0, 'send_to'=>$id])->groupBy('unique_id')->count();
    echo $count;
  }
}
