<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The long-answer fields on Non-Conformities and Work Instructions.
     *
     * The client asked for these to wrap instead of sitting on one line. They
     * were single-line <input>s, which is the half of it that shows; the other
     * half is that every one of them is varchar(255) and the connection runs
     * with strict mode off, so MySQL has been cutting whatever came past 255
     * characters without saying a word.
     *
     * Measured before writing this, on the English database:
     *
     *   tbl_noconformance.description     34 rows sitting at exactly 255
     *   tbl_workinstruction.point1..12    ~400 rows sitting at exactly 255
     *
     * "Exactly 255" is what truncation looks like. So widening the columns is
     * not a nicety alongside the textareas - without it the textarea would let
     * someone type a paragraph and the end of it would still disappear.
     *
     * TEXT holds 65,535 bytes, which is thousands of characters of Arabic.
     *
     * MODIFY COLUMN is safe to run twice: it sets the type to what it already
     * is. Widening never loses data - only going the other way would - so this
     * needs no backup step, and anything already truncated stays truncated;
     * this stops it happening again, it cannot bring back what has gone.
     */
    private $columns = [
        'tbl_noconformance' => [
            'description', 'rootCause', 'immediateCorp', 'actionPrevent', 'ActionRecurnce',
        ],
        'tbl_workinstruction' => [
            'scop',
            'point1', 'point2', 'point3', 'point4', 'point5', 'point6',
            'point7', 'point8', 'point9', 'point10', 'point11', 'point12',
        ],
    ];

    public function up()
    {
        foreach ($this->columns as $table => $columns) {
            if (!Schema::hasTable($table)) {
                continue;
            }
            foreach ($columns as $column) {
                if (!Schema::hasColumn($table, $column)) {
                    continue;
                }
                // leave it alone if some other hand has already widened it
                if ($this->isText($table, $column)) {
                    continue;
                }
                DB::statement("ALTER TABLE `{$table}` MODIFY COLUMN `{$column}` TEXT NULL");
            }
        }
    }

    /**
     * Narrowing TEXT back to varchar(255) would cut every value that has grown
     * past it, so this deliberately does nothing. Rolling the migration back
     * leaves the wider columns in place, which harms nothing.
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
