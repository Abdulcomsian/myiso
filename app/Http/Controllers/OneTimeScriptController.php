<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Self_;

class OneTimeScriptController extends Controller
{
    /**
     * This function add new column to table
     *
     * @author assad yaqoob
     * @date June 2022
     * @reference Using in below functions
     * @return void
     */
    private function _alterTableAddNewColumn($table_name,$column_name,$type,$after_column){
        DB::statement("
            ALTER TABLE ${table_name}
            ADD ${column_name} ${type}
            COLLATE utf8mb4_unicode_ci 
            DEFAULT NULL 
            AFTER ${after_column} ;
            ");
    }

    /**
    * This function add new column "cv" to table "tbl_employees"
    *
    * @author assad yaqoob
    * @date June 2022
    * @reference MyISOOnline Stage 3 Features - point 15
    * @return dd() string message
    */
    public function addCvColumnToEmployeesTable(){
        if (!Schema::hasColumn('tbl_employees', 'cv')) {
            self::_alterTableAddNewColumn('tbl_employees','cv','varchar(255)','jobdetails');
            dd('Added cv column to tbl_employees table');
        }else{
            dd('Already added cv column to tbl_employees table');
        }
    }

    /**
     * This function add new column "attach_evidence" to table "tbl_audit"
     *
     * @author assad yaqoob
     * @date June 2022
     * @reference MyISOOnline Stage 3 Features - point 15
     * @return dd() string message
     */
    public function addAttachEvidenceColumnToAuditTable(){
        if (!Schema::hasColumn('tbl_audit', 'attach_evidence')) {
            self::_alterTableAddNewColumn('tbl_audit','attach_evidence','varchar(255)','any_issues');
            dd('Added attach_evidence column to tbl_audit table');
        }else{
            dd('Already added attach_evidence column to tbl_audit table');
        }
    }

    /**
     * This function add new column "attach_evidence" to table "tbl_audit"
     * @description addAttEviAndIssuesColToQmsAuditTbl => addAttachEvidenceAndAnyIssuesColumnToQmsAuditTable
     * @author assad yaqoob
     * @date June 2022
     * @reference MyISOOnline Stage 3 Features - QMS audit page attachement evidence and any issues column fields
     * @return dd() string message
     */
    public function addAttEviAndIssuesColToQmsAuditTbl(){
        if (!Schema::hasColumns('tbl_qmsaudit', ['attach_evidence'])) {
            self::_alterTableAddNewColumn('tbl_qmsaudit','attach_evidence','varchar(255)','evidence');
            dump('Added attach_evidence column to tbl_qmsaudit table');
        }else{
            dump('Already added attach_evidence column to tbl_qmsaudit table');
        }

        if (!Schema::hasColumns('tbl_qmsaudit', ['any_issues'])) {
            self::_alterTableAddNewColumn('tbl_qmsaudit','any_issues','text','audit_comments_actions');
            dd('Added any_issues column to tbl_qmsaudit table');
        }else{
            dd('Already added any_issues column to tbl_qmsaudit table');
        }
    }

    /**
     * This function add new column "audit_report" to table "users"
     * @description When Admin creates a new user, the admin should be able to add “Audit Report”
     * @author assad yaqoob
     * @date July 2022
     * @reference https://app.asana.com/0/1202493007958961/1202515886858777
     * @return dd() string message
     */
    public function addAuditReportColToUsersTbl(){
        if (!Schema::hasColumns('users', ['audit_report'])) {
            self::_alterTableAddNewColumn('users','audit_report','varchar(255)','last_login');
            dd('Added audit_report column to users table');
        }else{
            dd('Already added audit_report column to users table');
        }
    }
}
