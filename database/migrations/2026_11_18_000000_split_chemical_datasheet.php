<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Chemical Control keeps two files, not one.
     *
     * The client's "Attach Supporting Evidence" document gives this page both
     * the manufacturer's datasheet it already had and the supporting evidence
     * every other form now has. The page only ever had one column,
     * attach_evidence, and the datasheet was being kept in it.
     *
     * Rather than leave Chemical Control as the one page where
     * attach_evidence means something else, the datasheet moves into a column
     * of its own and attach_evidence goes back to meaning what it means on
     * every other page. The rows already filled in are carried across, so no
     * datasheet is lost and none of them has to be uploaded again.
     *
     * Order matters: the column is added, the datasheets are copied into it,
     * and only then is attach_evidence cleared. If the run stops half way the
     * datasheets are in both columns, which is harmless, and running the
     * migration again finishes the job.
     *
     * Guarded throughout: if attach_datasheet is already there the whole
     * thing is skipped, so this is safe to run twice.
     */
    public function up()
    {
        if (!Schema::hasTable('chemical_control')) {
            return;
        }
        if (Schema::hasColumn('chemical_control', 'attach_datasheet')) {
            return;
        }

        Schema::table('chemical_control', function (Blueprint $t) {
            $t->string('attach_datasheet', 255)->nullable();
        });

        // what is in attach_evidence today is the datasheet
        DB::table('chemical_control')
            ->whereNotNull('attach_evidence')
            ->update(['attach_datasheet' => DB::raw('`attach_evidence`')]);

        // and attach_evidence starts empty, for the new field
        DB::table('chemical_control')
            ->whereNotNull('attach_evidence')
            ->update(['attach_evidence' => null]);
    }

    /**
     * Putting the datasheets back where they were and dropping the column.
     * Anything uploaded into the new supporting-evidence field after this ran
     * would be written over, so this is a rollback of the move and not a way
     * to undo the feature.
     */
    public function down()
    {
        if (!Schema::hasTable('chemical_control')
            || !Schema::hasColumn('chemical_control', 'attach_datasheet')) {
            return;
        }

        DB::table('chemical_control')
            ->whereNotNull('attach_datasheet')
            ->update(['attach_evidence' => DB::raw('`attach_datasheet`')]);

        Schema::table('chemical_control', function (Blueprint $t) {
            $t->dropColumn('attach_datasheet');
        });
    }
};
