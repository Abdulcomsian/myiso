<?php

namespace App\Http\Controllers;

use App\customer_review;
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
        $customers=customer_review::where('user_id',$userid)->get();
        return view('dashboard.form_records.customer_review',compact('customers'));
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
        //  $this->validate($request,[
        //     'revnumber'=>'required',
        // ]);
        try{
            $customer= new customer_review();
            $customer->user_id=Auth()->user()->id;
             $customer->revnumber=1401;
             $customer->cus_id=$request->input('cus_id');
             $customer->qualityScore=$request->input('qualityScore');
             $customer->priceScore=$request->input('priceScore');
             $customer->DScore=$request->input('DScore');
             $customer->OveralScore=$request->input('OveralScore');
             $customer->AssesmentDate=$request->input('AssesmentDate');
             $customer->save();
             //  Toastr->success('Have fun storming the castle!', 'Miracle Max Says');
              return redirect('/customer_review')->with("Success","Data Save Successfully");
         }catch(Exception $exc){
             return redirect('/customer_review')->with("Error","Error");
         }
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
        $id=$request->id;
        try{
            $customer= customer_review::find($id);
            $customer->user_id=Auth()->user()->id;
            //  $customer->revnumber=$request->input('revnumber');
             $customer->cus_id=$request->input('cus_id');
             $customer->qualityScore=$request->input('qualityScore');
             $customer->priceScore=$request->input('priceScore');
             $customer->DScore=$request->input('DScore');
             $customer->OveralScore=$request->input('OveralScore');
             $customer->AssesmentDate=$request->input('AssesmentDate');
             $customer->save();
             $notification = [
                'message' => 'Record  updated successfully.!',
                'alert-type' => 'success'
            ];
             return redirect('/customer_review')->with($notification);
        }catch(Exception $exc){
            print_r($exc->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\customer_review  $customer_review
     * @return \Illuminate\Http\Response
     */
    public function destroy(customer_review $customer_review)
    {
        //
    }
}
