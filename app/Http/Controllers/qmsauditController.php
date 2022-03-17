<?php

namespace App\Http\Controllers;
use App\Qmsaudit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yoeunes\Toastr\Facades\Toastr;
use DB;

class qmsauditController extends Controller
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
        $requirement=Qmsaudit::where('user_id',$userid)->get();
        return view('dashboard.form_records.qms_audit',compact('requirement'));
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
        //   print_r($request->all()); exit;

        // try{
            $Qmsaudit= new Qmsaudit();
              
      if(Auth::check() && Auth::user()->role_type == "admin"){
            $the_id = intval($request->input('user_id'));
       }else{
           $the_id = Auth()->user()->id;
       }        
       $Qmsaudit->QmsauditNumber="1";
       //$request->input('QmsauditNumber');
                $Qmsaudit->user_id=$the_id;
             $Qmsaudit->qmsCorects=$request->input('qmsCorects');
             $Qmsaudit->evidence=$request->input('evidence');
             $Qmsaudit->needExpactations=$request->input('needExpactations');
             $Qmsaudit->evidance2=$request->input('evidance2');
             $Qmsaudit->correction3=$request->input('correction3');
             $Qmsaudit->evidence3=$request->input('evidence3');
             $Qmsaudit->correction4=$request->input('correction4');
             $Qmsaudit->evidance4=$request->input('evidance4');
             $Qmsaudit->correction5=$request->input('correction5');
             $Qmsaudit->evidence5=$request->input('evidence5');
             $Qmsaudit->correction6=$request->input('correction6');
             $Qmsaudit->evidance7=$request->input('evidance7');
             $Qmsaudit->correction7=$request->input('correction7');
              $Qmsaudit->evidance7_1=$request->input('evidance7_1');
             $Qmsaudit->correction8=$request->input('correction8');
             $Qmsaudit->evidance8=$request->input('evidance8');
             $Qmsaudit->correction9=$request->input('correction9');
             $Qmsaudit->evidance10=$request->input('evidance10');
             $Qmsaudit->correction11=$request->input('correction11');
             $Qmsaudit->evidance12=$request->input('evidance12');
             $Qmsaudit->correction12=$request->input('correction12');
             $Qmsaudit->evidence13=$request->input('evidence13');
             $Qmsaudit->correction13=$request->input('correction13');
             $Qmsaudit->evidance14=$request->input('evidance14');
             $Qmsaudit->correction14=$request->input('correction14');
             $Qmsaudit->evidence14=$request->input('evidence14');
             $Qmsaudit->evidence28_1=$request->input('evidence28_1');
             
             $Qmsaudit->evidence17=$request->input('evidence17');
             $Qmsaudit->correction15=$request->input('correction15');
             $Qmsaudit->evidence15=$request->input('evidence15');
             $Qmsaudit->correction16=$request->input('correction16');
             $Qmsaudit->correciton17=$request->input('correciton17');
             $Qmsaudit->evidence18=$request->input('evidence18');
             $Qmsaudit->correction18=$request->input('correction18');
             $Qmsaudit->evidence19=$request->input('evidence19');
             $Qmsaudit->correction19=$request->input('correction19');
             $Qmsaudit->evidence20=$request->input('evidence20');
             $Qmsaudit->correction20=$request->input('correction20');
             $Qmsaudit->evidence21=$request->input('evidence21');
             $Qmsaudit->correction21=$request->input('correction21');
             $Qmsaudit->evidence22=$request->input('evidence22');
             $Qmsaudit->correction22=$request->input('correction22');
             $Qmsaudit->evidence23=$request->input('evidence23');
             $Qmsaudit->correction23=$request->input('correction23');
             $Qmsaudit->evidence24=$request->input('evidence24');
             $Qmsaudit->correction24=$request->input('correction24');
             $Qmsaudit->evidence25=$request->input('evidence25');
             $Qmsaudit->correction25=$request->input('correction25');
             $Qmsaudit->evidence26=$request->input('evidence26');
             $Qmsaudit->correction26=$request->input('correction26');
             $Qmsaudit->evidence27=$request->input('evidence27');
             $Qmsaudit->correction27=$request->input('correction27');
             $Qmsaudit->evidence28=$request->input('evidence28');
             $Qmsaudit->evidence29=$request->input('evidence29');
          
             $Qmsaudit->evidence30=$request->input('evidence30');
             $Qmsaudit->evidence31=$request->input('evidence31');
             $Qmsaudit->competedDate=$request->input('competedDate');
             $Qmsaudit->auditrName=$request->input('auditrName');
             $Qmsaudit->correction28=$request->input('correction28');
             $Qmsaudit->correction29=$request->input('correction29');
             $Qmsaudit->correction30=$request->input('correction30');
             $Qmsaudit->audit_comments_actions=$request->input('audit_comments_actions');
//   print_r($request->all());
             $Qmsaudit->save();

            //  Toastr->success('Have fun storming the castle!', 'Miracle Max Says');
             return redirect()->back()->with("Success","Data Save Successfully");
            //  return redirect('/qms_audit')->with("Success","Data Save Successfully");
        // }catch(Exception $exc){

        // }
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
        // dd($request->all());
        		$id = $request->id;

        $Qmsaudit=Qmsaudit::find( $id);
        
          if(Auth::check() && Auth::user()->role_type == "admin"){
            $the_id = intval($request->input('user_id'));
       }else{
           $the_id = Auth()->user()->id;
       }        
       
       
                $Qmsaudit->user_id=$the_id;
       
       
       

        

$Qmsaudit->QmsauditNumber="1";
//$request->input('QmsauditNumber');
             $Qmsaudit->qmsCorects=$request->input('qmsCorects');
             $Qmsaudit->evidence=$request->input('evidence');
             $Qmsaudit->needExpactations=$request->input('needExpactations');
             $Qmsaudit->evidance2=$request->input('evidance2');
             $Qmsaudit->correction3=$request->input('correction3');
             $Qmsaudit->evidence3=$request->input('evidence3');
             $Qmsaudit->correction4=$request->input('correction4');
             $Qmsaudit->evidance4=$request->input('evidance4');
             $Qmsaudit->correction5=$request->input('correction5');
             $Qmsaudit->evidence5=$request->input('evidence5');
             $Qmsaudit->correction6=$request->input('correction6');
             $Qmsaudit->evidance7=$request->input('evidance7');
             $Qmsaudit->correction7=$request->input('correction7');
             $Qmsaudit->evidance7_1=$request->input('evidance7_1');
             $Qmsaudit->correction8=$request->input('correction8');
             $Qmsaudit->evidance8=$request->input('evidance8');
             $Qmsaudit->correction9=$request->input('correction9');
             $Qmsaudit->evidance10=$request->input('evidance10');
             $Qmsaudit->correction11=$request->input('correction11');
             $Qmsaudit->evidance12=$request->input('evidance12');
             $Qmsaudit->correction12=$request->input('correction12');
             $Qmsaudit->evidence13=$request->input('evidence13');
             $Qmsaudit->correction13=$request->input('correction13');
             $Qmsaudit->evidance14=$request->input('evidance14');
             $Qmsaudit->evidence14=$request->input('evidence14');
             $Qmsaudit->evidence28_1=$request->input('evidence28_1');
             $Qmsaudit->correction14=$request->input('correction14');
             $Qmsaudit->evidence17=$request->input('evidence17');
             $Qmsaudit->correction15=$request->input('correction15');
             $Qmsaudit->evidence15=$request->input('evidence15');
             $Qmsaudit->correction16=$request->input('correction16');
             $Qmsaudit->correciton17=$request->input('correciton17');
             $Qmsaudit->evidence18=$request->input('evidence18');
             $Qmsaudit->correction18=$request->input('correction18');
             $Qmsaudit->evidence19=$request->input('evidence19');
             $Qmsaudit->correction19=$request->input('correction19');
             $Qmsaudit->evidence20=$request->input('evidence20');
             $Qmsaudit->correction20=$request->input('correction20');
             $Qmsaudit->evidence21=$request->input('evidence21');
             $Qmsaudit->correction21=$request->input('correction21');
             $Qmsaudit->evidence22=$request->input('evidence22');
             $Qmsaudit->correction22=$request->input('correction22');
             $Qmsaudit->evidence23=$request->input('evidence23');
             $Qmsaudit->correction23=$request->input('correction23');
             $Qmsaudit->evidence24=$request->input('evidence24');
             $Qmsaudit->correction24=$request->input('correction24');
             $Qmsaudit->evidence25=$request->input('evidence25');
             $Qmsaudit->correction25=$request->input('correction25');
             $Qmsaudit->evidence26=$request->input('evidence26');
             $Qmsaudit->correction26=$request->input('correction26');
             $Qmsaudit->evidence27=$request->input('evidence27');
             $Qmsaudit->correction27=$request->input('correction27');
             $Qmsaudit->evidence28=$request->input('evidence28');
             $Qmsaudit->evidence29=$request->input('evidence29');
            $Qmsaudit->evidence30=$request->input('evidence30');
             $Qmsaudit->evidence31=$request->input('evidence31');
             
             
              $Qmsaudit->correction28=$request->input('correction28');
             $Qmsaudit->correction29=$request->input('correction29');
             $Qmsaudit->correction30=$request->input('correction30');
             
             $Qmsaudit->competedDate=$request->input('competedDate');
             $Qmsaudit->auditrName=$request->input('auditrName');
$Qmsaudit->audit_comments_actions=$request->input('audit_comments_actions');


             $Qmsaudit->save();
            //  Toastr->success('Have fun storming the castle!', 'Miracle Max Says');
             return redirect()->back()->with("Success","Data Save Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // dd($request->id);
// 		$del = DB::table('tbl_qmsaudit')->delete($request->id);
	$req = 	DB::table('tbl_qmsaudit')
->where('QmsauditNumber',$request->id)
->delete();
			session()->flash('msg', 'Record deleted successfully.');
    return redirect()->back();
    }
}
