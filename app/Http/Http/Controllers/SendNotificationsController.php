<?php

namespace App\Http\Controllers;

use App\SendNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SendNotificationsController extends Controller
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
    public function index()
    {
        $userid=Auth::user()->id;
        $message_info=SendNotifications::where('send_to',$userid)->get();
        return view('dashboard.form_records.inboxmessage',compact('message_info'));
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
     * @param  \App\SendNotifications  $sendNotifications
     * @return \Illuminate\Http\Response
     */
    public function show(SendNotifications $sendNotifications)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SendNotifications  $sendNotifications
     * @return \Illuminate\Http\Response
     */
    public function edit(SendNotifications $sendNotifications)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SendNotifications  $sendNotifications
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SendNotifications $sendNotifications)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SendNotifications  $sendNotifications
     * @return \Illuminate\Http\Response
     */
    public function destroy(SendNotifications $sendNotifications)
    {
        //
    }
}
