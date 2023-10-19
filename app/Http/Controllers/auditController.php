<?php

namespace App\Http\Controllers;

use App\Audit;
use App\Helpers\HelperFunctions;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use PDF;
use Illuminate\Support\Facades\Response;

class auditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $userid=Auth::user()->id;
        $audit=Audit::where('user_id',$userid)->orderBy('id','DESC')->get();
        return view('dashboard.form_records.process_audit',compact('audit'));
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


    public function generatePDF(Request $request)
    {
        // $userId = auth()->user()->id;
        $audit = Audit::where('id', $request->process_id)->get();

        $pdf = PDF::loadView('dashboard.form_records.proces_audit', compact('audit'));

        $pdfPath = public_path('process_audit_report.pdf');

        $pdf->save($pdfPath);

        return response()->json(['url' => asset('process_audit_report.pdf')]);
    }
    
    public function downloadPDF()
    {
        $pdfPath = public_path('temp_audit.pdf');
        
        return Response::download($pdfPath, 'process_audit.pdf');
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//         print_r($request->all());
// 		$this->validate($request,[
//             'processAudit'=>'required',
//             'auditor'=>'required',
//             'auditDate'=>'required',
          
//             'Observations'=>'required',
//             'nonConfReport'=>'required',
//             'AdutiActions'=>'required',
//             'dateFrequency'=>'required',
//         ]);

        try{

            $Audit= new Audit;
            $Audit->user_id=Auth()->user()->id;
             $Audit->auditId=111;
             $Audit->processAudit=$request->input('processAudit');
             $Audit->auditor=$request->input('auditor');
             $Audit->auditDate=$request->input('auditDate');
             $Audit->nonConformities=$request->input('nonConformities');
             $Audit->Observations=$request->input('Observations');
             $Audit->nonConfReport=$request->input('nonConfReport');
             $Audit->AdutiActions=$request->input('AdutiActions');
             $Audit->dateFrequency=$request->input('dateFrequency');
             $Audit->qmsCorects=$request->input('qmsCorects');
             $Audit->evidence=$request->input('evidence');
             $Audit->needExpactations=$request->input('needExpactations');
             $Audit->evidance2=$request->input('evidance2');
             $Audit->correction3=$request->input('correction3');
             $Audit->evidence3=$request->input('evidence3');
             $Audit->correction4=$request->input('correction4');
             $Audit->evidance4=$request->input('evidance4');
             $Audit->correction5=$request->input('correction5');
             $Audit->evidence5=$request->input('evidence5');
             $Audit->correction6=$request->input('correction6');
             $Audit->evidance7=$request->input('evidance7');
             $Audit->correction7=$request->input('correction7');
             $Audit->evidance8=$request->input('evidance8');
             $Audit->correction9=$request->input('correction9');
             $Audit->evidance9=$request->input('evidance9');
             $Audit->correction10=$request->input('correction10');
             $Audit->evidance10=$request->input('evidance10');
             $Audit->any_issues=$request->input('any_issues');


            //Check if user attach evidence
            if ($request->file('attach_evidence') && Schema::hasColumn('tbl_audit','attach_evidence')) {
                //Delete previous attach evidence if exist
                $file = $request->file('attach_evidence');
                $path = '/uploads/user/attach_evidence/';
                $Audit->attach_evidence = HelperFunctions::saveFile($path,$file);
            }
             $test = $Audit->save();

             return redirect('/process_audit')->with("Success","Data Save Successfully");
        }catch(Exception $exc){
            print_r($exc->getMessage());
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
        
$nonConformities = $request->input('nonConformities');
if($nonConformities==NULL){
    $nonConformities="";
}
$any_issues = $request->input('any_issues');
if($any_issues==NULL){
    $any_issues="";
}

        try{
            $Audit=Audit::find($id);
            $Audit->user_id=Auth()->user()->id;
             $Audit->processAudit=$request->input('processAudit');
             $Audit->auditor=$request->input('auditor');
             $Audit->auditDate=$request->input('auditDate');
             $Audit->nonConformities=$nonConformities;
             $Audit->Observations=$request->input('Observations');
             $Audit->nonConfReport=$request->input('nonConfReport');
             $Audit->AdutiActions=$request->input('AdutiActions');
             $Audit->dateFrequency=$request->input('dateFrequency');
			 
			  $Audit->qmsCorects=$request->input('qmsCorects');
             $Audit->evidence=$request->input('evidence');
             $Audit->needExpactations=$request->input('needExpactations');
             $Audit->evidance2=$request->input('evidance2');
             $Audit->correction3=$request->input('correction3');
             $Audit->evidence3=$request->input('evidence3');
             $Audit->correction4=$request->input('correction4');
             $Audit->evidance4=$request->input('evidance4');
             $Audit->correction5=$request->input('correction5');
             $Audit->evidence5=$request->input('evidence5');
             $Audit->correction6=$request->input('correction6');
             $Audit->evidance7=$request->input('evidance7');
             $Audit->correction7=$request->input('correction7');
             $Audit->evidance8=$request->input('evidance8');
             $Audit->correction9=$request->input('correction9');
             $Audit->evidance9=$request->input('evidance9');
             $Audit->correction10=$request->input('correction10');
             $Audit->evidance10=$request->input('evidance10');
             $Audit->any_issues=$any_issues;

            //Check if user attach evidence
            if ($request->file('attach_evidence') && Schema::hasColumn('tbl_audit','attach_evidence')) {
                //Delete previous attach evidence if exist
                if (File::exists(public_path($Audit->attach_evidence))) {
                    File::delete(public_path($Audit->attach_evidence));
                }

                $file = $request->file('attach_evidence');
                $path = '/uploads/user/attach_evidence/';
                $Audit->attach_evidence = HelperFunctions::saveFile($path,$file);
            }

             $Audit->save();

             $notification = [
                'message' => 'Record  updated successfully.!',
                'alert-type' => 'success'
            ];
             return redirect('/process_audit')->with($notification);
        }catch(Exception $exc){
            print_r($exc->getMessage());
        }
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
        $audit = Audit::find($id);
        if (File::exists(public_path($audit->attach_evidence))) {
            File::delete(public_path($audit->attach_evidence));
        }
        $audit->delete();

        $notification = [
            'message' => 'Record  Deleted successfully.!',
            'alert-type' => 'success'
        ];

        return redirect('/process_audit')->with($notification);

    }
}