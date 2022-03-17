<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store2(Request $request)
    {
        return "sadas";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //
    }
        public function UpdateUserInfo(Request $request){
        return "sfdfds";
    //     $id=$request->id;
    //     $Company_overview=$request->input('Company_overview');
    //     $user=AddUsers::find($id);
    //     if($request->input('password') !='' || !empty($request->input('password'))){
    //         $pass=$request->input('password');
    //         $user->password=Hash::make($pass);
    //     }
    //     $user->phone=$request->input('phone');
    //     $user->director=$request->input('director');
    //     $user->sales_process=$request->input('sales_process');
    //   $user->company_profile=$request->input('company_profile');
    //   $user->company_address=$request->input('company_address');
    //   $user->purchasing_process=$request->input('purchasing_process');
    //   $user->servicing_process=$request->input('servicing_process');
    //   $user->competency_process=$request->input('competency_process');
    //   $user->scope=$request->input('scope');
    //   $user->order_number=$request->input('order_number');
    //     $user->Company_overview=$request->input('Company_overview');
    //   $user->save();
        
    }
}
