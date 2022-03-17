<?php

namespace App\Http\Controllers;

use App\EmployeeTraning;
use Illuminate\Http\Request;

class EmployeeTraningController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeeTraning  $employeeTraning
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeTraning $employeeTraning)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeTraning  $employeeTraning
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeTraning $employeeTraning)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeTraning  $employeeTraning
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeTraning $employeeTraning)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeTraning  $employeeTraning
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeTraning $employeeTraning)
    {
        //
    }
}
