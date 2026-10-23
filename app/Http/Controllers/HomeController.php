<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }




    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = \Auth::user()->id;

        $user = User::find($id);

        // Compute days since the PREVIOUS last_login (before we overwrite it)
        $showInactivityAlert = false;
        if ($user->last_login) {
            $daysInactive = \Carbon\Carbon::parse($user->last_login)->diffInDays(now());
            if ($daysInactive >= 90) {
                $showInactivityAlert = true;
            }
        }

        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        // the Objectives card is the tracker listing now, so it comes from the
        // controller that owns it rather than a query in the blade
        return view('dashboard.index', array_merge(
            compact('user', 'showInactivityAlert'),
            ObjectiveController::dashboardList($id),
            ['requirement' => RequiremntController::dashboardList($id),
             'calibration' => CalibrationController::dashboardList($id),
             // each standard's own audit report, shown beside its certificate
             'stdDocs'     => \App\UserDocument::currentFor($id),
             // what renewals and re-uploads replaced: the admin could see
             // this on the Edit User form and the client could not
             'prevDocs'    => \App\UserDocument::archivedFor($id)]
        ));
    }
    
    /** where the Previous Certificates card's pager fetches from */
    public function previousDocuments(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/home');
        }
        return view('dashboard.partials.dash_previous_docs', [
            'prevDocs' => \App\UserDocument::archivedFor(\Auth::user()->id),
        ]);
    }

    /**
     * Drops one superseded document off the client's own history.
     *
     * Scoped to the signed-in client and to is_current = 0, so it can reach
     * neither somebody else's history nor the document they are certified
     * against today. The file on disk is left alone, as the admin's copy of
     * this action leaves it.
     */
    public function removePreviousDocument(Request $request)
    {
        \App\UserDocument::where('user_id', \Auth::user()->id)
            ->where('is_current', 0)
            ->where('id', $request->input('id'))
            ->delete();

        return redirect('/home');
    }

    public function usertype(){
        $userType=Auth()->users()->role_type;
        if($userType =='admin'){
            return view('dashboard.admin.index');
        }else{
            return view('dashboard.index');
        }
    }
}
