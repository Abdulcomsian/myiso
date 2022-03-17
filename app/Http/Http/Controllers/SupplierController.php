<?php

namespace App\Http\Controllers;

use App\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
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
        $supplier=Supplier::where('user_id',$userid)->get();
        return view('dashboard.form_records.supplier',compact('supplier'));
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
            'suppliername'=>'required',
        ]);
        try{
            $idnumber=123;
            $supplier= new Supplier();
            $supplier->user_id=Auth()->user()->id;
             $supplier->idnumber=$idnumber;
             $supplier->suppliername=$request->input('suppliername');
             $supplier->supplieraddress=$request->input('supplieraddress');
             $supplier->suppliercity=$request->input('suppliercity');
             $supplier->supplierstate=$request->input('supplierstate');
             $supplier->supplierzip=$request->input('supplierzip');

             $supplier->suppliercountry=$request->input('suppliercountry');
             $supplier->supplierphn=$request->input('supplierphn');
             $supplier->supplieremail=$request->input('supplieremail');
             $supplier->supplierContactNumber=$request->input('supplierContactNumber');
             $supplier->supplierservc=$request->input('supplierservc');
             $supplier->save();
             //  Toastr->success('Have fun storming the castle!', 'Miracle Max Says');
              return redirect('/supplier')->with("Success","Data Save Successfully");
         }catch(Exception $exc){
             return redirect('/supplier')->with("Error","Error");
         }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id=$request->id;
        $supplier=Supplier::find($id);
            $supplier->user_id=Auth()->user()->id;
             $supplier->idnumber=$request->input('idnumber');
             $supplier->suppliername=$request->input('suppliername');
             $supplier->supplieraddress=$request->input('supplieraddress');
             $supplier->suppliercity=$request->input('suppliercity');
             $supplier->supplierstate=$request->input('supplierstate');
             $supplier->supplierzip=$request->input('supplierzip');

             $supplier->suppliercountry=$request->input('suppliercountry');
             $supplier->supplierphn=$request->input('supplierphn');
             $supplier->supplieremail=$request->input('supplieremail');
             $supplier->supplierContactNumber=$request->input('supplierContactNumber');
             $supplier->supplierservc=$request->input('supplierservc');
             $supplier->save();
             $notification = [
                'message' => 'Record  updated successfully.!',
                'alert-type' => 'success'
            ];
             return redirect('/supplier')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {

        $id=$req->id;
        $req=Supplier::find($id)->delete();
        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];
        return redirect('/supplier')->with($notification);

    }
}
