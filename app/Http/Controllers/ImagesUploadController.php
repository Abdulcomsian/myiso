<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class ImagesUploadController extends Controller
{
    //
    public function index(Request $request){
    $user = Auth::user();
//  echo $user;exit;
 if ($file = $request->file('sales_process_photo')) {
      $optimizePath = public_path('/uploads/process');
      $r = rand();
      $ext = $request->file('sales_process_photo')->extension();
      $img_only = 'sale_processes_'.$r.'.'.$ext;
       $file->move($optimizePath.'/',$img_only);
       $img = asset('public/uploads/process/'.$img_only);

      if(DB::table('images_uploads')->Where('user_id',$user->id)->exists()){
            $update = DB::table('images_uploads')->where('user_id',$user->id)->update(['sales_process' => $img]); 
      } else{   
            $insert_data = array(
					   'sales_process' => $img,
					   'user_id' => $user->id
				     );
            $insert = DB::table('images_uploads')->insert($insert_data);
      }
            return redirect()->back()->with('message', 'Image uploaded successfully.');
       
    }
    
    if ($file = $request->file('purch_process_photo')) {
      $optimizePath = public_path('/uploads/process');         
      $r = rand();
      $ext = $request->file('purch_process_photo')->extension();
      
      $img_only = 'purch_process_photo_'.$r.'.'.$ext;
       $file->move($optimizePath.'/',$img_only);
       $img = asset('public/uploads/process/'.$img_only);

      if(DB::table('images_uploads')->Where('user_id',$user->id)->exists()){
            $update = DB::table('images_uploads')->where('user_id',$user->id)->update([ 'purchasing_process' => $img]); 
      } else{   
          $insert_data = array(
					   'purchasing_process' => $img,
					   'user_id' => $user->id
				     );
            $insert = DB::table('images_uploads')->insert($insert_data);
      }
             return redirect()->back()
       ->with('message', 'Image uploaded successfully.');
    }
    
    if ($file = $request->file('serv_process_photo')) {
         
      $optimizePath = public_path('/uploads/process');         
     
      $r = rand();
      $ext = $request->file('serv_process_photo')->extension();
      $img_only = 'serv_process_photo_'.$r.'.'.$ext;
       $file->move($optimizePath.'/',$img_only);
       $img = asset('public/uploads/process/'.$img_only);

      if(DB::table('images_uploads')->Where('user_id',$user->id)->exists()){
            $update = DB::table('images_uploads')->where('user_id',$user->id)->update([ 'servicing_contract' => $img]); 
      } else{   
          $insert_data = array(
					   'servicing_contract' => $img,
					   'user_id' => $user->id
				     );
            $insert = DB::table('images_uploads')->insert(                $insert_data
		    );
      }
             return redirect()->back()
       ->with('message', 'Image uploaded successfully.');
    }
    if ($file = $request->file('comp_process_photo')) {
         
      $optimizePath = public_path('/uploads/process');         
     
      $r = rand();
      $ext = $request->file('comp_process_photo')->extension();
     $img_only = 'competency_process_'.$r.'.'.$ext;
       $file->move($optimizePath.'/',$img_only);
       $img = asset('public/uploads/process/'.$img_only);

      if(DB::table('images_uploads')->Where('user_id',$user->id)->exists()){
            $update = DB::table('images_uploads')->where('user_id',$user->id)->update([ 'competency_process' => $img]); 
      } else{   
          $insert_data = array(
					   'competency_process' => $img,
					   'user_id' => $user->id
				     );
            $insert = DB::table('images_uploads')->insert(                $insert_data
		    );
      }
             return redirect()->back()
       ->with('message', 'Image uploaded successfully.');
    }
     if ($file = $request->file('process_int_photo')) {
         
      $optimizePath = public_path('/uploads/process');         
     
      $r = rand();
      $ext = $request->file('process_int_photo')->extension();
         $img_only = 'process_interaction_'.$r.'.'.$ext;
       $file->move($optimizePath.'/',$img_only);
       $img = asset('public/uploads/process/'.$img_only);

      if(DB::table('images_uploads')->Where('user_id',$user->id)->exists()){
            $update = DB::table('images_uploads')->where('user_id',$user->id)->update([ 'process_interaction' => $img]); 
      } else{   
          $insert_data = array(
					   'process_interaction' => $img,
					   'user_id' => $user->id
				     );
            $insert = DB::table('images_uploads')->insert(                $insert_data
		    );
      }
             return redirect()->back()
       ->with('message', 'Image uploaded successfully.');
    }
    if ($file = $request->file('organogram')) {
         
      $optimizePath = public_path('/uploads/process');
     
      $r = rand();
      $ext = $request->file('organogram')->extension();
         $img_only = 'management_organogram_'.$r.'.'.$ext;
       $file->move($optimizePath.'/',$img_only);
       $img = asset('public/uploads/process/'.$img_only);

      if(DB::table('images_uploads')->Where('user_id',$user->id)->exists()){
            $update = DB::table('images_uploads')->where('user_id',$user->id)->update([ 'management_organogram' => $img]); 
      } else{   
          $insert_data = array(
					   'management_organogram' => $img,
					   'user_id' => $user->id
				     );
            $insert = DB::table('images_uploads')->insert(                $insert_data
		    );
      }
             return redirect()->back()
       ->with('message', 'Image uploaded successfully.');
    }
    
    return redirect()->back();
    }
    public function removesales(){
        
      $user = Auth::user(); 
       $update = DB::table('images_uploads')->where('user_id',$user->id)->update(['sales_process' => NULL]); 
        return redirect()->back()
       ->with('message', 'Image Removed successfully.');
    }
    public function purchprocess(){
        
      $user = Auth::user(); 
       $update = DB::table('images_uploads')->where('user_id',$user->id)->update(['purchasing_process' => NULL]); 
        return redirect()->back()
       ->with('message', 'Image Removed successfully.');
    }
    public function servicingprocess(){
        
      $user = Auth::user(); 
       $update = DB::table('images_uploads')->where('user_id',$user->id)->update(['servicing_contract' => NULL]); 
        return redirect()->back()
       ->with('message', 'Image Removed successfully.');
    }
    public function comptprocess(){
        
      $user = Auth::user(); 
       $update = DB::table('images_uploads')->where('user_id',$user->id)->update(['competency_process' => NULL]); 
        return redirect()->back()
       ->with('message', 'Image Removed successfully.');
    }
    public function processinteraction(){
        
      $user = Auth::user(); 
       $update = DB::table('images_uploads')->where('user_id',$user->id)->update(['process_interaction' => NULL]); 
        return redirect()->back()
       ->with('message', 'Image Removed successfully.');
    }
    public function mgmtorg(){
        
      $user = Auth::user(); 
       $update = DB::table('images_uploads')->where('user_id',$user->id)->update(['management_organogram' => NULL]); 
        return redirect()->back()
       ->with('message', 'Image Removed successfully.');
    }
    public function sale_process(){
        $img_exist ="";
       $user = Auth::user();
        $user_exists = DB::table('images_uploads')->Where('user_id',$user->id)->count();

        if($user_exists == 0){
             $img= DB::table('admin_org_structure_images')->pluck('sales_process')[0];
             
        }else{
            $uploaded_img_tb = DB::table('images_uploads')->Where('user_id',$user->id)->first();
            if($uploaded_img_tb->sales_process!=""){
               $img = $uploaded_img_tb->sales_process;
               $img_exist = "Yes";
            }else{
                $img= DB::table('admin_org_structure_images')->pluck('sales_process')[0];
                $img_exist = "No";
            }
        }
        // echo $img;exit;
        return view('dashboard.processes.sale_processes',compact('img', 'img_exist'));
        
    }
    
    public function purchasing_process(){
        $user = Auth::user();
        $user_exists = DB::table('images_uploads')->Where('user_id',$user->id)->count();
 $img_exist ="";
        if($user_exists == 0){
           
             $img= DB::table('admin_org_structure_images')->pluck('purchasing_process')[0];
        }else{
            $uploaded_img_tb = DB::table('images_uploads')->Where('user_id',$user->id)->first();
            if($uploaded_img_tb->purchasing_process!=""){
               $img = $uploaded_img_tb->purchasing_process;
               $img_exist = "Yes";
            }else{
                $img= DB::table('admin_org_structure_images')->pluck('purchasing_process')[0];
                $img_exist = "No";
            }
        }
        return view('dashboard.processes.purchasing_process',compact('img', 'img_exist')); 
    }
    
    public function servicing_contract(){
        $user = Auth::user();
        $user_exists = DB::table('images_uploads')->Where('user_id',$user->id)->count();
 $img_exist ="";
        if($user_exists == 0){
           
             $img= DB::table('admin_org_structure_images')->pluck('servicing_contract')[0];
        }else{
            $uploaded_img_tb = DB::table('images_uploads')->Where('user_id',$user->id)->first();
            if($uploaded_img_tb->servicing_contract!=""){
               $img = $uploaded_img_tb->servicing_contract;
               $img_exist = "Yes";
            }else{
                $img= DB::table('admin_org_structure_images')->pluck('servicing_contract')[0];
                $img_exist = "No";
            }
        }
        return view('dashboard.processes.servicing_contract',compact('img', 'img_exist'));
        
    }
    
    public function competency_process(){
        $user = Auth::user();
		
		$user_exists = DB::table('images_uploads')->Where('user_id',$user->id)->count();
 $img_exist ="";
        if($user_exists == 0){
           
             $img= DB::table('admin_org_structure_images')->pluck('competency_process')[0];
        }else{
            $uploaded_img_tb = DB::table('images_uploads')->Where('user_id',$user->id)->first();
            if($uploaded_img_tb->competency_process!=""){
               $img = $uploaded_img_tb->competency_process;
               $img_exist = "Yes";
            }else{
                $img= DB::table('admin_org_structure_images')->pluck('competency_process')[0];
                $img_exist = "No";
            }
        }
		
        return view('dashboard.processes.competency_process',compact('img', 'img_exist')); 
    }
    
    
    
    public function process_interaction(){
        $user = Auth::user();
		
		$user_exists = DB::table('images_uploads')->Where('user_id',$user->id)->count();
$img_exist ="";
        if($user_exists == 0){
             $img= DB::table('admin_org_structure_images')->pluck('process_interaction')[0];
        }else{
            $uploaded_img_tb = DB::table('images_uploads')->Where('user_id',$user->id)->first();
            if($uploaded_img_tb->process_interaction!=""){
               $img = $uploaded_img_tb->process_interaction;
               $img_exist = "Yes";
            }else{
                $img= DB::table('admin_org_structure_images')->pluck('process_interaction')[0];
                $img_exist = "No";
            }
        }
				
        return view('dashboard.processes.process_interaction',compact('img', 'img_exist')); 
        
    }
    
    
    
    public function management_organogram(){
        $user = Auth::user();
		
		$user_exists = DB::table('images_uploads')->Where('user_id',$user->id)->count();
$img_exist ="";
        if($user_exists == 0){
             $img= DB::table('admin_org_structure_images')->pluck('management_organogram')[0];
        }else{
            $uploaded_img_tb = DB::table('images_uploads')->Where('user_id',$user->id)->first();
            if($uploaded_img_tb->management_organogram!=""){
               $img = $uploaded_img_tb->management_organogram;
                $img_exist = "Yes";
            }else{
                $img= DB::table('admin_org_structure_images')->pluck('management_organogram')[0];
                $img_exist = "No";
            }
        }
		
        return view('dashboard.mannual_policy.management_organogram',compact('img', 'img_exist')); 
    }
}
