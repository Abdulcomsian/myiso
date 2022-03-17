<?php

namespace App\Http\Controllers;

use App\customers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
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
        $customers=customers::where('user_id',$userid)->get();
        
 
        return view('dashboard.form_records.customer',compact('customers'));
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

       try{
           $customer= new customers();
           $customer->user_id=Auth()->user()->id;
            $customer->idNumber=121;
            $customer->name=$request->input('name');
            $customer->address=$request->input('address');
            $customer->phoneNumber=$request->input('phoneNumber');
            $customer->Email=$request->input('Email');
            $customer->contactName=$request->input('contactName');
            $customer->save();
            //  Toastr->success('Have fun storming the castle!', 'Miracle Max Says');
             return redirect('/customer')->with("Success","Data Save Successfully");
        }catch(Exception $exc){
            return redirect('/customer')->with("Error","Error");
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
        $id=$request->id;
        $customer=customers::find($id);
        $customer->user_id=Auth()->user()->id;
         $customer->name=$request->input('name');
         $customer->address=$request->input('address');
         $customer->phoneNumber=$request->input('phoneNumber');
         $customer->Email=$request->input('Email');
         $customer->contactName=$request->input('contactName');
         $customer->save();
          return redirect('/customer')->with("Success","Data Save Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
