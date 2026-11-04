<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Who filed an interested party, and who last changed it.
     *
     * The client asked the details popup to show a proper timeline rather than
     * a bare "Created At" - the date, the time, and the person. The date and
     * time were already there in created_at; the person was not recorded
     * anywhere, and it genuinely differs: interestedController::store() lets
     * an admin file a record against a client's account, so a row's user_id
     * says whose it is, never who typed it.
     *
     * Both columns hold a users.id. No foreign key: a deleted account would
     * then either block the delete or wipe the record's history, and neither
     * is wanted - a missing id simply shows as a dash.
     *
     * Rows that existed before this stay null. There is nothing on file that
     * says who made them, and inventing an answer would be worse than an
     * honest blank - their date and time still show.
     */
    public function up()
    {
        if (!Schema::hasTable('interested_parties')) {
            return;
        }
        Schema::table('interested_parties', function (Blueprint $t) {
            if (!Schema::hasColumn('interested_parties', 'created_by')) {
                $t->unsignedInteger('created_by')->nullable()->after('needs');
            }
            if (!Schema::hasColumn('interested_parties', 'updated_by')) {
                $t->unsignedInteger('updated_by')->nullable()->after('created_by');
            }
        });
    }

    /**
     * Dropping these would throw away the only record of who did what, so
     * rolling back deliberately leaves them. They harm nothing.
     */
    public function down()
    {
        //
    }
};
