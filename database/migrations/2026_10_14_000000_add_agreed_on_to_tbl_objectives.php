<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * "Agreed at" can now be a date in its own right.
     *
     * agreed_at still holds the Management Review's id. agreed_on holds the
     * date the objective was agreed: copied from that review, or typed by hand
     * when the meeting was not a recorded review. Until now an objective
     * agreed at a review carried no date of its own at all, so nothing could
     * sort or report on it without joining back through the review.
     */
    public function up()
    {
        if (!Schema::hasTable('tbl_objectives')) {
            return;                                  // the table itself is a --path= migration
        }

        if (!Schema::hasColumn('tbl_objectives', 'agreed_on')) {
            Schema::table('tbl_objectives', function (Blueprint $table) {
                $table->date('agreed_on')->nullable()->after('agreed_at');
            });
        }

        // Fill in what the existing rows already imply. reviewdate is a
        // varchar, so anything that is not a plain date is left alone rather
        // than turned into 0000-00-00 or allowed to stop the migration. Only
        // rows still empty are touched, so this is safe to run again and will
        // never overwrite a date somebody has since typed.
        if (Schema::hasTable('tbl_mgtreviews')) {
            DB::statement(
                "UPDATE tbl_objectives o
                   JOIN tbl_mgtreviews m ON m.id = o.agreed_at
                    SET o.agreed_on = STR_TO_DATE(m.reviewdate, '%Y-%m-%d')
                  WHERE o.agreed_on IS NULL
                    AND m.reviewdate REGEXP '^[0-9]{4}-[0-9]{2}-[0-9]{2}$'"
            );
        }
    }

    public function down()
    {
        if (Schema::hasTable('tbl_objectives') && Schema::hasColumn('tbl_objectives', 'agreed_on')) {
            Schema::table('tbl_objectives', function (Blueprint $table) {
                $table->dropColumn('agreed_on');
            });
        }
    }
};
