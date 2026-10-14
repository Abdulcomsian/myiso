<?php

namespace App\Http\Controllers;

use App\requirement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use SweetAlert;

class RequiremntController extends Controller
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

    /**
     * The first page of this user's requirements, for the Dashboard card.
     *
     * The same records as before - no condition added, none taken away - but
     * ordered and paged the way the full page does it. Paging without a fixed
     * order can repeat or skip rows, so the order has to be spelled out.
     */
    public static function dashboardList($userId)
    {
        return requirement::where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->paginate(10, ['*'], 'reqpage');
    }

    /** where the Dashboard card's pager fetches from: the list and nothing else */
    public function dashboardIndex(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/home');
        }
        return view('dashboard.partials.dash_requirements', [
            'requirement' => self::dashboardList(Auth::user()->id),
        ]);
    }

    public function index(Request $request)
    {
        $userid  = Auth::user()->id;
        $search  = trim($request->query('q', ''));
        $query   = requirement::where('user_id', $userid)->orderBy('id', 'DESC');
        if ($search !== '') {
            $query->where('requirment_title', 'like', "%{$search}%");
        }
        $requirement = $query->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return view('dashboard.form_records.partials.requirements_table', compact('requirement'));
        }

        return view('dashboard.form_records.requirements_aspect', compact('requirement', 'search'));
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
        // print_r($request->all());
        $this->validate($request,[
            'requirement'=>'required',
            'completiondate'=>'required',
            'month'=>'required',
        ]);
        $duedate=$request->input('month');
        $completionDate=$request->input('completiondate');
        $effectiveDate = date('Y-m-d', strtotime($completionDate . "'.$duedate.' months") );
        $next_due_date = date('d-m-Y', strtotime($completionDate. ' +30 days'));
        // echo $next_due_date;
        try{
            $requirement= new requirement();
            $requirement->user_id=Auth()->user()->id;
             $requirement->requirment_title=$request->input('requirement');
             $requirement->completion_date=$request->input('completiondate');
             $requirement->periods=$request->input('month');
             $requirement->due_date=$next_due_date;
             $requirement->save();
            //  SweetAlert::message('Robots are working!');
            //  echo "123";exit;
             return redirect('/requirements_aspect')->with("Success","Data Save Successfully");
        }catch(Exception $exc){
dd($exc->getMessage());
        }




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id=$request->requirment_id;

        $requirement= requirement::find($id);
        $requirement->user_id=Auth()->user()->id;
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
        return redirect('/requirements_aspect')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {

        $id=$req->id;
        $req=requirement::find($id)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];
        return redirect('/requirements_aspect')->with($notification);

    }
      public function destroy1($id)
    {
        $req=requirement::find($id)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];
        return redirect('/requirements_aspect')->with($notification);

    }
}
