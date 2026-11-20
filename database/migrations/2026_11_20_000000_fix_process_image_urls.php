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
     * Checked against the live server:
     *
     *   English site
     *     /uploads/process/<file>            200 OK, image
     *     /public/uploads/process/<file>     404
     *     www.myisoonline.com/...            TLS failure, certificate covers
     *                                        myisoonline.com only
     *
     *   Arabic site
     *     /ar/public/uploads/process/<file>  200 OK, image
     *
     * The two sites do NOT share an uploads folder - each serves its own,
     * from a different prefix. That is why what gets stored is the path and
     * the page draws it through asset(): every site already knows its own
     * prefix, from ASSET_URL. A url built by one site, or a bare leading
     * slash, would send the other to a folder its file is not in.
     *
     * WHAT THIS DOES
     *
     * Keeps the path and drops everything in front of it, so each value
     * becomes /uploads/process/<file>. The page then renders asset() on it:
     * the English site answers https://myisoonline.com/uploads/process/...
     * and the Arabic one https://myisoonline.com/ar/public/uploads/process/...
     * from the very same stored value. The controller now stores it in that
     * shape to begin with.
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

    /**
     * Every value this is about to change, written to a file before it
     * changes, so down() can put them all back.
     *
     * mysqldump is not available to the shell user on the live server, so a
     * backup taken by hand is not something to rely on here. This one needs
     * no credentials: it goes through the connection the application already
     * has, and the file lands in storage/app/.
     */
    private function backup(array $rows)
    {
        $dir = storage_path('app');
        if (!is_dir($dir)) {
            @mkdir($dir, 0775, true);
        }

        $file = $dir . '/process_image_urls_backup_' . date('Y-m-d_His') . '.json';
        file_put_contents($file, json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        return $file;
    }

    /** the newest backup this migration wrote, or null */
    private function newestBackup()
    {
        $found = glob(storage_path('app') . '/process_image_urls_backup_*.json');
        if (!$found) {
            return null;
        }
        sort($found);
        return array_pop($found);
    }

    public function up()
    {
        $fixedTotal = 0;
        $left = [];
        $before = [];

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

                    // what it was, before it stops being that
                    $before[] = [
                        'table'  => $table,
                        'column' => $column,
                        'id'     => $row->id,
                        'was'    => $value,
                    ];

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

        if ($before) {
            echo "  backup: " . $this->backup($before) . "\n"
               . "  (to put them all back: php artisan migrate:rollback --path=" . $this->here() . ")\n";
        }

        if ($left) {
            echo "  " . count($left) . " row(s) left alone - they point at another domain,\n"
               . "  where the file is and here it is not. Rewriting them would\n"
               . "  break a picture that works today:\n";
            foreach ($left as $one) {
                echo "    $one\n";
            }
        }
    }

    /** this file's path, for the message up() prints */
    private function here()
    {
        $root = str_replace('\\', '/', base_path()) . '/';
        return str_replace($root, '', str_replace('\\', '/', __FILE__));
    }

    /**
     * Put every value back exactly as it was, from the file up() wrote.
     *
     * This is the backup, and it is why no mysqldump is needed: the old
     * urls are kept in storage/app/ and restored from there, through the
     * application's own connection.
     *
     * Worth knowing before using it: the values it restores are the broken
     * ones. Rolling back undoes the repair and the images go back to not
     * showing. It is here for the case where something unexpected happened,
     * not as a second opinion.
     */
    public function down()
    {
        $file = $this->newestBackup();

        if ($file === null) {
            echo "  no backup file found - nothing to put back\n";
            return;
        }

        $rows = json_decode((string) file_get_contents($file), true);
        if (!is_array($rows)) {
            echo "  backup file could not be read: $file\n";
            return;
        }

        $put = 0;
        foreach ($rows as $row) {
            if (!Schema::hasTable($row['table']) || !Schema::hasColumn($row['table'], $row['column'])) {
                continue;
            }
            DB::table($row['table'])->where('id', $row['id'])
                ->update([$row['column'] => $row['was']]);
            $put++;
        }

        echo "  $put row(s) put back from " . basename($file) . "\n";
    }
};
