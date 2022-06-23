<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class OneTimeScriptController extends Controller
{
    public function addNewColumnToEmployeesTable(){
        if (!Schema::hasColumn('tbl_employees', 'cv')) {
            $result = DB::statement('
            ALTER TABLE tbl_employees
            ADD cv varchar(255)
            COLLATE utf8mb4_unicode_ci 
            DEFAULT NULL
            ');
            dd('Added cv column to tbl_employees table');
        }else{
            dd('Already added cv column to tbl_employees table');
        }
    }
}
