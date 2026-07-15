<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Auth;

class AdminController extends Controller
{
    /**
     * Display a listing e of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stats = [
            'total_users'          => DB::table('users')->count(),
            'users_this_month'     => DB::table('users')
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->count(),
            'total_downloads'      => DB::table('downloads')->count(),
            'total_notifications'  => DB::table('send_notification')->count(),
        ];

        $upcomingNotifications = $this->buildUpcomingNotifications();

        return view('admin.dashboard.index', compact('stats', 'upcomingNotifications'));
    }

    /**
     * Build the "Upcoming Notifications" list for the dashboard.
     * Matches the LoginNotificationSchedule command's rules:
     *   - Thresholds: 90 (3-month), 180 (6-month), 300 (10-month).
     *   - For each inactivity period (defined by last_login), each threshold
     *     is sent at most once. Logging in resets the cycle because
     *     dedup is scoped by created_at > last_login.
     *   - "Upcoming" = the next unsent threshold for this period is within 10 days.
     */
    private function buildUpcomingNotifications()
    {
        $userIdToExclude = 1011;
        $thresholds = [90, 180, 300];
        $labels = [90 => '3-Month', 180 => '6-Month', 300 => '10-Month'];
        $windowDays = 10;

        // Only pull users whose inactivity is at least (90 - 10) = 80 days,
        // and cap at 300 (past 300 nothing more to schedule).
        $candidates = User::whereNotNull('last_login')
            ->where('last_login', '<=', Carbon::now()->subDays(min($thresholds) - $windowDays))
            ->where('id', '!=', $userIdToExclude)
            ->get();

        $upcoming = [];

        foreach ($candidates as $u) {
            $lastLogin    = Carbon::parse($u->last_login);
            $daysInactive = (int) $lastLogin->diffInDays(Carbon::now());

            // Find the next threshold that hasn't been sent for the current period.
            $nextThreshold = null;
            foreach ($thresholds as $th) {
                $alreadySent = DB::table('send_notification')
                    ->where('send_to', $u->id)
                    ->where('total_days', $th)
                    ->where('created_at', '>', $u->last_login)
                    ->exists();

                if (!$alreadySent) {
                    $nextThreshold = $th;
                    break;
                }
            }

            if ($nextThreshold === null) {
                continue;
            }

            $daysUntil = $nextThreshold - $daysInactive;
            if ($daysUntil < 0 || $daysUntil > $windowDays) {
                continue;
            }

            $upcoming[] = (object) [
                'user_id'         => $u->id,
                'name'            => $u->name ?? '—',
                'email'           => $u->email ?? '—',
                'last_login'      => $lastLogin,
                'days_inactive'   => $daysInactive,
                'threshold'       => $nextThreshold,
                'threshold_label' => $labels[$nextThreshold],
                'days_until'      => $daysUntil,
                'scheduled_on'    => $lastLogin->copy()->addDays($nextThreshold),
            ];
        }

        usort($upcoming, function ($a, $b) {
            return $a->days_until <=> $b->days_until;
        });

        return $upcoming;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
    
    public function organization_images()
    {
         $user = Auth::user();
        $images=DB::table('admin_org_structure_images')->Where('user_id',$user->id)->get();
       // print_r($images);exit;
        return view('admin.dashboard.admin.organization-structure',compact('images'));
    }
    
    public function organization_structure(Request $request)
    {
         $user = Auth::user();
       if($file = $request->file('Organization_Image'))
       {
             $optimizePath = public_path('/uploads/process');
             $r = rand();
             $ext = $request->file('Organization_Image')->extension();
             $img_only = 'management_organogram_'.$r.'.'.$ext;
             $file->move($optimizePath.'/',$img_only);
             $img = asset('public/uploads/process/'.$img_only);
              if(DB::table('admin_org_structure_images')->Where('user_id',$user->id)->exists())
              {
                    $update = DB::table('admin_org_structure_images')->where('user_id',$user->id)->update([ 'management_organogram' => $img]); 
              } else{   
                  $insert_data = array(
        					   'management_organogram' => $img,
        					   'user_id' => $user->id
        				     );
                    $insert = DB::table('admin_org_structure_images')->insert($insert_data);
              }
             
       }
       
       if ($file = $request->file('Sales_Process')) {
          $optimizePath = public_path('/uploads/process');
          $r = rand();
          $ext = $request->file('Sales_Process')->extension();
          $img_only = 'sale_processes_'.$r.'.'.$ext;
           $file->move($optimizePath.'/',$img_only);
           $img = asset('public/uploads/process/'.$img_only);
    
          if(DB::table('admin_org_structure_images')->Where('user_id',$user->id)->exists()){
                $update = DB::table('admin_org_structure_images')->where('user_id',$user->id)->update([ 'sales_process' => $img]); 
          } else{   
              $insert_data = array(
    					   'sales_process' => $img,
    					   'user_id' => $user->id
    				     );
                $insert = DB::table('admin_org_structure_images')->insert(                $insert_data
    		    );
          }
                
           
        }
        
       if ($file = $request->file('Purchasing_Process')) {
          $optimizePath = public_path('/uploads/process');         
          $r = rand();
          $ext = $request->file('Purchasing_Process')->extension();
          
          $img_only = 'purch_process_photo_'.$r.'.'.$ext;
           $file->move($optimizePath.'/',$img_only);
           $img = asset('public/uploads/process/'.$img_only);
    
          if(DB::table('admin_org_structure_images')->Where('user_id',$user->id)->exists()){
                $update = DB::table('admin_org_structure_images')->where('user_id',$user->id)->update([ 'purchasing_process' => $img]); 
          } else{   
              $insert_data = array(
    					   'purchasing_process' => $img,
    					   'user_id' => $user->id
    				     );
                $insert = DB::table('admin_org_structure_images')->insert(                $insert_data
    		    );
          }
                
        }
        
       if ($file = $request->file('Servicing_Contract_Process')) 
       {
             
          $optimizePath = public_path('/uploads/process');         
          $r = rand();
          $ext = $request->file('Servicing_Contract_Process')->extension();
          $img_only = 'serv_process_photo_'.$r.'.'.$ext;
           $file->move($optimizePath.'/',$img_only);
           $img = asset('public/uploads/process/'.$img_only);
    
          if(DB::table('admin_org_structure_images')->Where('user_id',$user->id)->exists()){
                $update = DB::table('admin_org_structure_images')->where('user_id',$user->id)->update([ 'servicing_contract' => $img]); 
          } else{   
              $insert_data = array(
    					   'servicing_contract' => $img,
    					   'user_id' => $user->id
    				     );
                $insert = DB::table('admin_org_structure_images')->insert(                $insert_data
    		    );
          }
                 
        }
        
       if ($file = $request->file('Competency_Process')) 
       {
         
          $optimizePath = public_path('/uploads/process');         
          $r = rand();
          $ext = $request->file('Competency_Process')->extension();
          $img_only = 'competency_process_'.$r.'.'.$ext;
           $file->move($optimizePath.'/',$img_only);
           $img = asset('public/uploads/process/'.$img_only);
    
          if(DB::table('admin_org_structure_images')->Where('user_id',$user->id)->exists()){
                $update = DB::table('admin_org_structure_images')->where('user_id',$user->id)->update([ 'competency_process' => $img]); 
          } else{   
              $insert_data = array(
    					   'competency_process' => $img,
    					   'user_id' => $user->id
    				     );
                $insert = DB::table('admin_org_structure_images')->insert(                $insert_data
    		    );
          }
                 
        }
        
       if ($file = $request->file('Process_Interaction')) 
       {
         
          $optimizePath = public_path('/uploads/process');         
         
          $r = rand();
          $ext = $request->file('Process_Interaction')->extension();
             $img_only = 'process_interaction_'.$r.'.'.$ext;
           $file->move($optimizePath.'/',$img_only);
           $img = asset('public/uploads/process/'.$img_only);
    
          if(DB::table('admin_org_structure_images')->Where('user_id',$user->id)->exists()){
                $update = DB::table('admin_org_structure_images')->where('user_id',$user->id)->update([ 'process_interaction' => $img]); 
          } else{   
              $insert_data = array(
    					   'process_interaction' => $img,
    					   'user_id' => $user->id
    				     );
                $insert = DB::table('admin_org_structure_images')->insert(                $insert_data
    		    );
          }
                 
        }
         return redirect()->back()->with('message', 'Image uploaded successfully.');
    }
}
