<?php

namespace App\Http\Controllers;

use App\customer_review;
use App\customers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userid=Auth::user()->id;
        $all_customers=customers::where('user_id',$userid)->get();
        $customers=customer_review::where('user_id',$userid)->orderBy('id','DESC')->get();
        return view('dashboard.form_records.customer_review',compact('customers','userid','all_customers'));
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
        
        // dd($request->all());
        if(Auth::check() && Auth::user()->role_type == "admin"){
                $the_id = intval($request->input('user_id'));
        }else{
            $the_id = Auth()->user()->id;
        } 
        // uploading evidence
        if($request->file('attach_evidence')){
            $file = $request->file('attach_evidence');
            $fileDestination = public_path('customer_review_evidence/');
            $filename = rand() . time() . '.' .$request->file('attach_evidence')->getClientOriginalExtension();
            $file->move($fileDestination, $filename);
        }
        // try{
            $customer= new customer_review();
            $customer->user_id=$the_id;
             $customer->revnumber=1401;
             $customer->cus_id=$request->input('cus_id');
             $customer->qualityScore=$request->input('qualityScore');
             $customer->priceScore=$request->input('priceScore');
             $customer->DScore=$request->input('DScore');
             $customer->OveralScore=$request->input('OveralScore');
             $customer->AssesmentDate=$request->input('AssesmentDate');
             $customer->other_issues=$request->input('other_issue');
             $customer->attach_evidence = $filename;
             $customer->product_activity_area = $request->input('product_activity_area');
             $customer->save();
             //  Toastr->success('Have fun storming the castle!', 'Miracle Max Says');
              return redirect()->back()->with("Success","Data Save Successfully");
        //  }catch(Exception $exc){
        //      return redirect('/customer_review')->with("Error","Error");
        //  }
        }
    /**
     * Display the specified resource.
     *
     * @param  \App\customer_review  $customer_review
     * @return \Illuminate\Http\Response
     */
    public function show(customer_review $customer_review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\customer_review  $customer_review
     * @return \Illuminate\Http\Response
     */
    public function edit(customer_review $customer_review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\customer_review  $customer_review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        if($request->file('attach_evidence')){
            $file = $request->file('attach_evidence');
            $filename = rand() . time() . '.' . $request->file('attach_evidence')->getClientOriginalExtension();
            $filepath = public_path('customer_review_evidence/');
            $file->move($filepath, $filename);
        }
        $id=$request->id;
        // try{
              if(Auth::check() && Auth::user()->role_type == "admin"){
            $the_id = intval($request->input('user_id'));
       }else{
           $the_id = Auth()->user()->id;
       }  
            $customer= customer_review::find($id);
            $customer->user_id=$the_id;
            //  $customer->revnumber=$request->input('revnumber');
             $customer->cus_id=$request->input('cus_id');
             $customer->qualityScore=$request->input('qualityScore');
             $customer->priceScore=$request->input('priceScore');
             $customer->DScore=$request->input('DScore');
             $customer->OveralScore=$request->input('OveralScore');
             $customer->AssesmentDate=$request->input('AssesmentDate');
             $customer->other_issues = $request->input('other_issue');
             if($request->hasFile('attach_evidence')){
                $customer->attach_evidence = $filename;
            }
             $customer->product_activity_area = $request->input('product_activity_area_edit');
             $customer->save();
             $notification = [
                'message' => 'Record  updated successfully.!',
                'alert-type' => 'success'
            ];
             return redirect()->back()->with($notification);
        // }catch(Exception $exc){
        //     print_r($exc->getMessage());
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\customer_review  $customer_review
     * @return \Illuminate\Http\Response
     */
     public function destroy(Request $request)
    {
        //
        // echo $request->id;exit;
        customer_review::find($request->id)->delete();
        session()->flash('msg', 'Record deleted successfully.');
    return redirect()->back();
        
    }
}
