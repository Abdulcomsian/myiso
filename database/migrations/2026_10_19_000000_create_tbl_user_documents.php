<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * A client's certification documents, one row per document.
     *
     * Until now the users table held a single audit_report and a single
     * qa_certification for the whole client, so a client who gained a second
     * ISO standard on a later date lost the first standard's paperwork - the
     * row was overwritten and the PDF was deleted off disk. This table gives
     * every standard its own audit report and QA agreement, and keeps what is
     * replaced instead of destroying it.
     *
     * What stays where, deliberately:
     *   - users.iso*_certificate / _expirydate / _description keep holding the
     *     CURRENT certificate. The notification and reporting filters in
     *     AddUsersController and SendNotificationsController query those
     *     columns directly ("clients with only ISO9001", "clients with all
     *     three"), so moving them would break reports nobody asked us to touch.
     *   - users.audit_report / audit_comment / qa_certification keep holding
     *     the general, standard-less document a client may already have. 265
     *     clients have one of these today; they keep working untouched.
     *   - this table holds the per-standard documents, and every superseded
     *     document of any kind, including certificates replaced at renewal.
     */
    public function up()
    {
        if (Schema::hasTable('tbl_user_documents')) {
            return;                                   // already created
        }

        Schema::create('tbl_user_documents', function (Blueprint $table) {
            $table->bigIncrements('id');

            // matches users.id, which is int unsigned
            $table->unsignedInteger('user_id');

            // 'iso9001' | 'iso14001' | 'iso45001'
            $table->string('standard', 20);

            // 'certificate' | 'audit_report' | 'qa_agreement'
            $table->string('doc_type', 20);

            $table->string('file_path', 255);

            // the audit comment, or a certificate's description
            $table->text('comment')->nullable();

            // only a certificate carries one
            $table->date('expiry_date')->nullable();

            // 1 = what the client sees now, 0 = superseded, which is what the
            // "Previous Certificates & Audit Reports" section lists
            $table->boolean('is_current')->default(true);
            $table->timestamp('archived_at')->nullable();

            $table->timestamps();

            // the two ways this table is read: everything current for a client,
            // and one particular document of one standard
            $table->index(['user_id', 'is_current'], 'tud_user_current');
            $table->index(['user_id', 'standard', 'doc_type'], 'tud_user_std_type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_user_documents');
    }
};
