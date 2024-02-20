<?php

namespace App\Http\Controllers;

use App\Nonconform;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class nonConfromFormController extends Controller
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
    public function index(Request $request)
    {
        $userid=Auth::user()->id;
       
        $nonconform=Nonconform::where('user_id',$userid)->get();
        $customers = DB::table('tbl_suppliers')->where('user_id',$userid)->get();
       
         if(count($customers)==0)
         {
            $no_customer=1;
        }else{
            $no_customer=0;
        }
        // if(count($customers)==0){
        //     return redirect('/customer')->with("Success","Please add customer first");
        // }
        // SELECT b.name FROM `tbl_noconformance` as a, tbl_customer as b WHERE a.customerID = b.idNumber;
        $customers_nonconform = DB::table('tbl_noconformance')->join('tbl_customer','tbl_noconformance.customerID','tbl_customer.idNumber')->select('tbl_noconformance.id as noid','tbl_noconformance.*','tbl_customer.*')->where('tbl_noconformance.user_id',$userid)->where('tbl_customer.user_id',$userid)->orderBy('tbl_noconformance.id','DESC')->get();
        $employees= DB::table('tbl_employees')->where('user_id',$userid)->get();

        if(count($employees)==0)
        {
           $no_employees=1;
       }else{
           $no_employees=0;
       }
        
        //  $customers_nonconform = DB::table('tbl_noconformance')->join('tbl_customer','tbl_noconformance.customerID','tbl_customer.idNumber')
        // ->select('tbl_noconformance.id as noid','tbl_noconformance.*','tbl_customer.*')
        // ->where('tbl_noconformance.user_id',$request)->get();
        // dd($customers_nonconform);
        // dd($customers);
 
        return view('dashboard.form_records.non_conformities',compact('userid', 'nonconform','customers', 'customers_nonconform', 'no_customer','employees'));
    }

    /**
     * Show the form for creatings a new resource.
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
        // echo '<pre>'; print_r($request->all());exit;
// dd($request->all());
    //    try{
        // dd()
        if(Auth::check() && Auth::user()->role_type == "admin")
        {
             $the_id = $request->input('user_id');
            // echo 'is admin';
            // exit;
        }else{
            $the_id = Auth()->user()->id;
        }
           $nonConform= new Nonconform();
           $nonConform->user_id=$the_id;
           $nonConform->customerID=$request->input('customerID');
           $nonConform->CustomerName=$request->input('CustomerName');
           $nonConform->description=$request->input('description');
           $nonConform->rootCause=$request->input('rootCause');
           $nonConform->immediateCorp=$request->input('immediateCorp');
           $nonConform->actionPrevent=$request->input('actionPrevent');
           $nonConform->ActionRecurnce=$request->input('ActionRecurnce');
           $nonConform->effectiveDate=$request->input('effectiveDate');
           $nonConform->reviewdBy=$request->input('reviewdBy');
           $nonConform->dateNcP=$request->input('dateNcP');
           $nonConform->dateNcR=$request->input('dateNcR');
           $nonConform->CRE=$request->input('CRE');
           $nonConform->PI=$request->input('PI');
           $nonConform->NCR_closed=$request->input('NCR_closed');
           $nonConform->root_cause_category=$request->input('root_cause_category');
           $nonConform->supplier_data=$request->input('supplier_data');
           $nonConform->employee_id=$request->input('employee_id');
           $nonConform->employee_name=$request->input('employee_name');
           $nonConform->save();
        //    dd($nonConform);
           return redirect()->back();
           return redirect('/non_confromities')->with("Success","Data Save Successfully");
    //    }catch(Exception $exception){
    //        print_r($exception);
    //    }

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
        
        $id=$request->id;
        $nonConform=Nonconform::find($id);
         if(Auth::check() && Auth::user()->role_type == "admin"){
             $the_id = $request->input('user_id');
        }else{
            $the_id = Auth()->user()->id;
            
        }

        $nonConform->user_id= $the_id;
        $nonConform->customerID=$request->input('customerID');
        $nonConform->CustomerName=$request->input('CustomerName');
        $nonConform->description=$request->input('description');
        $nonConform->rootCause=$request->input('rootCause');
        $nonConform->immediateCorp=$request->input('immediateCorp');
        $nonConform->actionPrevent=$request->input('actionPrevent');
        $nonConform->ActionRecurnce=$request->input('ActionRecurnce');
        $nonConform->effectiveDate=$request->input('effectiveDate');
        $nonConform->reviewdBy=$request->input('reviewdBy');
        $nonConform->dateNcP=$request->input('dateNcP');
        $nonConform->dateNcR=$request->input('dateNcR');
        $nonConform->CRE=$request->input('CRE');
        $nonConform->PI=$request->input('PI');
        $nonConform->NCR_closed=$request->input('NCR_closed');
        $nonConform->root_cause_category=$request->input('root_cause_category');
        $nonConform->supplier_data=$request->input('supplier_data');

        $nonConform->employee_id=$request->input('employee_id');
        $nonConform->employee_name=$request->input('employee_name');
        $test  = $nonConform->save();
        return back();
        // return redirect('/non_confromities')->with("Success","Data Save Successfully");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        // echo $request->id;exit;
         $nonConform=Nonconform::find($request->id)->delete();
         return back();
    }
    
    
    
    public function get_customer_name_by_id(Request $request)
    {   $id = $request['id']; 
        $user_id = $request['user_id']; 
        $tbl_customer = DB::table('tbl_customer')->where('user_id',$request->input('user_id'))->where('idNumber', $id)->first();
    
     echo json_encode(array('Status' => true, 'name'=>$tbl_customer->name));
    }


    public function get_employee_name_by_id(Request $request)
    {   
        $id = $request['id']; 
        $user_id = $request['user_id']; 
        $tbl_employees = DB::table('tbl_employees')->where('user_id',$request->input('user_id'))->where('empNumber', $id)->first();
        echo json_encode(array('Status' => true, 'surname'=>$tbl_employees->surname));
    }
    
    
    
}