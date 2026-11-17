<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Somewhere to keep the supporting evidence on the three registers.
     *
     * Environmental Aspects & Impacts, Hazards (Health & Safety) and
     * Incident & Injury are drawn by one shared controller and one pair of
     * partials, and the client's "Attach Supporting Evidence" document shows
     * the field on all three. They had neither the field nor a column behind
     * it, so an upload would have been taken and dropped.
     *
     * varchar(255), null, exactly as the other seventeen tables that carry
     * one. It holds the url of the uploaded file, not the file.
     *
     * The field is optional, so every existing row simply stays null.
     *
     * Guarded table by table: these two databases have drifted over the years
     * and a table missing on one site must not stop the rest.
     */
    private $tables = [
        'tbl_environmental_impacts',   // Environmental Aspects & Impacts
        'tbl_hazards',                 // Hazards (Health & Safety)
        'tbl_incidents',               // Incident & Injury
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
