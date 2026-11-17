<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Somewhere to keep the supporting evidence on the nine forms that had
     * nowhere to put it.
     *
     * The client's "Attach Supporting Evidence" document shows the field on
     * every form. Nine of them had neither the field nor a column behind it:
     * the field alone would take an upload and drop it on the floor, so the
     * column comes first.
     *
     * varchar(255), null, exactly as the eight tables that already carry one.
     * It holds the url of the uploaded file, not the file.
     *
     * Two of these tables already keep a file for a different purpose and
     * keep it: tbl_employees has the CV, tbl_objectives has the evidence on a
     * progress note (which lives in tbl_objective_updates). Neither is the
     * evidence for the record itself, which is what this column is for.
     *
     * The field is optional on every form - the client asked for that - so
     * every existing row simply stays null and nothing needs backfilling.
     *
     * Guarded table by table: these two databases have drifted over the years
     * and a table that is missing on one site must not stop the rest.
     */
    private $tables = [
        'tbl_customer',         // Customers
        'tbl_employees',        // Employees
        'interested_parties',   // Interested Parties
        'tbl_noconformance',    // Non-Conformities
        'tbl_objectives',       // Objectives Tracker
        'tbl_requiremnt',       // Requirements Due
        'assessments',          // Risk Assessments
        'tbl_suppliers',        // Suppliers
        'tbl_workinstruction',  // Work Instructions
    ];

    public function up()
    {
        foreach ($this->tables as $table) {
            if (!Schema::hasTable($table)) {
                continue;
            }
            if (Schema::hasColumn($table, 'attach_evidence')) {
                continue;
            }
            Schema::table($table, function (Blueprint $t) {
                $t->string('attach_evidence', 255)->nullable();
            });
        }
    }

    public function down()
    {
        foreach ($this->tables as $table) {
            if (!Schema::hasTable($table) || !Schema::hasColumn($table, 'attach_evidence')) {
                continue;
            }
            Schema::table($table, function (Blueprint $t) {
                $t->dropColumn('attach_evidence');
            });
        }
    }
};
