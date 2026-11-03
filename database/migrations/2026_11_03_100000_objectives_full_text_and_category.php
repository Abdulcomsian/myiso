<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Two things the Objectives Tracker needs.
     *
     * 1. tbl_objectives.objective was varchar(500), and the connection runs
     *    with strict mode off, so anything longer was cut without a word.
     *    Measured before writing this: one English row sits at exactly 500
     *    characters, which is what truncation looks like. The Management
     *    Review columns it is copied from (newquality, newenvironmental,
     *    newhealthsafety) are already TEXT, so the text was whole until it
     *    reached here.
     *
     *    Widening cannot bring back what has already gone - that row stays
     *    cut - it only stops it happening again.
     *
     * 2. A new 'category' column remembers which of the three Management
     *    Review boxes an objective came from, so the tracker can show the same
     *    heading the meeting wrote it under. It holds the box's field name -
     *    newquality / newenvironmental / newhealthsafety - rather than a
     *    label, so the English and Arabic sites can word it their own way.
     *
     *    Objectives already in the tracker are matched back to their review by
     *    text, so the headings appear on the existing rows too rather than
     *    only on ones added from today.
     *
     * Everything here is guarded and safe to run twice.
     */
    private $boxes = ['newquality', 'newenvironmental', 'newhealthsafety'];

    public function up()
    {
        if (!Schema::hasTable('tbl_objectives')) {
            return;
        }

        // 1. the objective itself, no longer capped
        if (Schema::hasColumn('tbl_objectives', 'objective') && !$this->isText('tbl_objectives', 'objective')) {
            DB::statement('ALTER TABLE `tbl_objectives` MODIFY COLUMN `objective` TEXT NULL');
        }

        // 2. where it came from
        if (!Schema::hasColumn('tbl_objectives', 'category')) {
            Schema::table('tbl_objectives', function (Blueprint $t) {
                $t->string('category', 32)->nullable()->after('objective');
            });
        }

        $this->backfillCategory();
    }

    /**
     * Narrowing TEXT back to varchar(500) would cut every value that has grown
     * past it, and dropping the column would lose the headings, so rolling
     * back deliberately leaves both in place. Neither harms anything.
     */
    public function down()
    {
        //
    }

    /**
     * An objective made from a review carries that review's id in agreed_at,
     * and its text was copied from one of the three boxes - truncated to 500
     * characters on the way, which is why the comparison truncates the source
     * the same way. A row that matches none of them is left null rather than
     * guessed at, and so is anything the client typed into the tracker by hand.
     */
    private function backfillCategory()
    {
        if (!Schema::hasTable('tbl_mgtreviews')) {
            return;
        }
        foreach ($this->boxes as $box) {
            if (!Schema::hasColumn('tbl_mgtreviews', $box)) {
                return;
            }
        }

        $cases = '';
        foreach ($this->boxes as $box) {
            $cases .= " WHEN o.objective = LEFT(TRIM(m.`{$box}`), 500) THEN '{$box}'";
        }

        DB::statement("
            UPDATE `tbl_objectives` o
              JOIN `tbl_mgtreviews` m ON m.id = o.agreed_at
               SET o.category = CASE{$cases} END
             WHERE o.category IS NULL
               AND o.agreed_at IS NOT NULL
               AND o.agreed_at > 0
        ");
    }

    /**
     * SHOW COLUMNS cannot be given a bound parameter - MySQL will not prepare
     * "LIKE ?" there - so the whole column list is read and matched here.
     */
    private function isText($table, $column)
    {
        foreach (DB::select("SHOW COLUMNS FROM `{$table}`") as $row) {
            if ($row->Field === $column) {
                return stripos($row->Type, 'text') !== false;
            }
        }
        return false;
    }
};
