<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Puts back the ends of objectives that were cut on their way out of a
     * Management Review.
     *
     * tbl_objectives.objective was varchar(500), and addObjectives() cut the
     * text to 500 characters as well, so a long objective reached the tracker
     * with its tail missing. Widening the column stopped that happening again
     * but could not undo it.
     *
     * It turns out it can be undone. The review keeps the original: its
     * newquality / newenvironmental / newhealthsafety columns are TEXT and
     * were never cut. So wherever a stored objective is exactly the first 500
     * characters of the box it came from, and that box is longer than 500,
     * the stored value is provably the truncated copy and the whole thing can
     * be written back over it.
     *
     * Measured before writing this, on the English database:
     *   objective 4644 held 500 characters; review 316's newquality holds 633,
     *   and the stored value matched its first 500 exactly.
     *
     * The equality is what makes this safe. A row that has been edited since,
     * or that was typed into the tracker by hand, matches nothing and is left
     * alone. Running it twice does nothing the second time, because by then
     * the stored text is the whole box and no longer equals its first 500
     * characters.
     *
     * The category is set in the same statement. It is normally already there
     * from the previous migration, but that one matches on the truncated form
     * too, so doing it here as well keeps the two independent of each other.
     */
    private $boxes = ['newquality', 'newenvironmental', 'newhealthsafety'];

    public function up()
    {
        if (!Schema::hasTable('tbl_objectives') || !Schema::hasTable('tbl_mgtreviews')) {
            return;
        }
        if (!Schema::hasColumn('tbl_objectives', 'objective') || !Schema::hasColumn('tbl_objectives', 'category')) {
            return;
        }
        // pointless, and lossy, while the column still cannot hold the rest
        if (!$this->isText('tbl_objectives', 'objective')) {
            return;
        }

        foreach ($this->boxes as $box) {
            if (!Schema::hasColumn('tbl_mgtreviews', $box)) {
                continue;
            }
            DB::statement("
                UPDATE `tbl_objectives` o
                  JOIN `tbl_mgtreviews` m ON m.id = o.agreed_at
                   SET o.objective = TRIM(m.`{$box}`),
                       o.category  = '{$box}'
                 WHERE o.agreed_at IS NOT NULL
                   AND o.agreed_at > 0
                   AND CHAR_LENGTH(TRIM(m.`{$box}`)) > 500
                   AND o.objective = LEFT(TRIM(m.`{$box}`), 500)
            ");
        }
    }

    /**
     * Cutting the text back down again would be the bug this undoes, so
     * rolling back deliberately does nothing.
     */
    public function down()
    {
        //
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
