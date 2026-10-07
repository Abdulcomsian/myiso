<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * How often a work instruction is to be reviewed or actioned.
     *
     * A short key is stored rather than the wording - 'quarterly', not
     * 'Quarterly' - so the English and Arabic sites can each show their own
     * label for the same record, the way Incident severity already does.
     */
    public function up()
    {
        Schema::table('tbl_workinstruction', function (Blueprint $table) {
            if (!Schema::hasColumn('tbl_workinstruction', 'reviewFrequency')) {
                $table->string('reviewFrequency', 32)->nullable()->after('revisionstatus');
            }
        });
    }

    public function down()
    {
        Schema::table('tbl_workinstruction', function (Blueprint $table) {
            if (Schema::hasColumn('tbl_workinstruction', 'reviewFrequency')) {
                $table->dropColumn('reviewFrequency');
            }
        });
    }
};
