<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Point the process images back at the files.
     *
     * No table changes shape here - this is a repair of six columns'
     * contents, written as a migration only so it can be run on live the way
     * everything else is, with artisan and no database password to hand.
     *
     * WHAT WAS WRONG
     *
     * ImagesUploadController stored the FULL url at the moment of upload:
     *
     *     $img = asset('/uploads/process/'.$img_only);
     *
     * Whatever address the site answered to that day was frozen into the row
     * for ever. The hosting has changed since, and 111 of 133 stored images
     * were left pointing at a place the file is not - some with a /public/
     * segment, some on the www host whose certificate does not cover it, one
     * at a developer's local address, several at a domain no longer in use.
     *
     * Checked against the live server, the same file:
     *
     *     /uploads/process/<file>            200 OK, image
     *     /public/uploads/process/<file>     404
     *     /ar/uploads/process/<file>         404
     *     /ar/public/uploads/process/<file>  404
     *     www.myisoonline.com/...            TLS failure, certificate covers
     *                                        myisoonline.com only
     *
     * A file uploaded through the ARABIC site is served from that same
     * /uploads/process/ - the two sites share one folder.
     *
     * WHAT THIS DOES
     *
     * Keeps the path and drops everything in front of it, so each value
     * becomes /uploads/process/<file> whatever it was before. A leading
     * slash resolves against whichever site draws the page, so one stored
     * value serves both and survives the next move. The controller now
     * stores it in that shape to begin with.
     *
     * SUBSTRING_INDEX(..., '/uploads/', -1) takes what follows the LAST
     * '/uploads/', so a doubled prefix collapses too. Rows already in that
     * shape are skipped, which makes this safe to run again.
     *
     * No file is touched and no row is deleted.
     */
    private $columns = [
        'process_interaction',
        'sales_process',
        'purchasing_process',
        'servicing_contract',
        'competency_process',
        'management_organogram',
    ];

    /** the clients' own uploads, and the defaults a new account starts with */
    private $tables = ['images_uploads', 'admin_org_structure_images'];

    public function up()
    {
        foreach ($this->tables as $table) {
            if (!Schema::hasTable($table)) {
                continue;
            }

            foreach ($this->columns as $column) {
                if (!Schema::hasColumn($table, $column)) {
                    continue;
                }

                $fixed = DB::table($table)
                    ->where($column, 'like', '%/uploads/%')
                    ->where($column, 'not like', '/uploads/%')
                    ->update([
                        $column => DB::raw(
                            "CONCAT('/uploads/', SUBSTRING_INDEX(`$column`, '/uploads/', -1))"
                        ),
                    ]);

                if ($fixed > 0) {
                    echo "  $table.$column: $fixed row(s) fixed\n";
                }
            }
        }
    }

    /**
     * There is nothing to undo. The values this replaced were the broken
     * ones - urls pointing at addresses the site no longer answers to - and
     * putting them back would only break the images again. The files
     * themselves were never touched.
     */
    public function down()
    {
        // deliberately empty
    }
};
