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
     * becomes /uploads/process/<file>. A leading slash resolves against
     * whichever site draws the page, so one stored value serves both and
     * survives the next move. The controller now stores it in that shape to
     * begin with.
     *
     * SUBSTRING_INDEX(..., '/uploads/', -1) takes what follows the LAST
     * '/uploads/', so a doubled prefix collapses too. Rows already in that
     * shape are skipped, which makes this safe to run again.
     *
     * WHAT IT DELIBERATELY LEAVES ALONE
     *
     * Only rows whose host is this site are rewritten. A handful point at
     * myisoarabia.com, and those are not broken - checked on the live
     * server:
     *
     *     myisoarabia.com/uploads/process/<file>   200 OK
     *     myisoonline.com/uploads/process/<file>   404   (same filename)
     *
     * Those files live on the other domain and nowhere else, so rewriting
     * them to a path on this one would take a working image and break it.
     * They are counted and named at the end instead, for someone to decide
     * about: either copy the files across, or leave the rows as they are.
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

    /** the only hosts whose files are known to live under this site */
    private $ours = ['myisoonline.com', 'www.myisoonline.com'];

    public function up()
    {
        $fixedTotal = 0;
        $left = [];

        foreach ($this->tables as $table) {
            if (!Schema::hasTable($table)) {
                continue;
            }

            foreach ($this->columns as $column) {
                if (!Schema::hasColumn($table, $column)) {
                    continue;
                }

                $rows = DB::table($table)
                    ->where($column, 'like', '%/uploads/%')
                    ->where($column, 'not like', '/uploads/%')
                    ->get(['id', $column]);

                $fixed = 0;

                foreach ($rows as $row) {
                    $value = $row->$column;
                    $host  = strtolower((string) parse_url($value, PHP_URL_HOST));

                    // a host we do not serve: the file is there and not here,
                    // so leave it be and say so at the end
                    if ($host !== '' && !in_array($host, $this->ours, true)) {
                        $left[] = "$table.$column #{$row->id}  $value";
                        continue;
                    }

                    $path = (string) parse_url($value, PHP_URL_PATH);
                    $at   = strrpos($path, '/uploads/');
                    if ($at === false) {
                        continue;
                    }

                    DB::table($table)->where('id', $row->id)
                        ->update([$column => substr($path, $at)]);
                    $fixed++;
                }

                if ($fixed > 0) {
                    echo "  $table.$column: $fixed row(s) fixed\n";
                    $fixedTotal += $fixed;
                }
            }
        }

        echo "  ---\n  $fixedTotal row(s) repaired\n";

        if ($left) {
            echo "  " . count($left) . " row(s) left alone - they point at another domain,\n"
               . "  where the file is and here it is not. Rewriting them would\n"
               . "  break a picture that works today:\n";
            foreach ($left as $one) {
                echo "    $one\n";
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
