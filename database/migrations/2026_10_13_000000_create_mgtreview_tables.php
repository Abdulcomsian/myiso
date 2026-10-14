<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Management Reviews moved from 16 free-text boxes to the client's twelve
     * questions plus a decisions, objectives, actions and files section.
     *
     * The answers, the actions and the meeting files each go in a table of
     * their own rather than into more columns on tbl_mgtreviews, the same way
     * the QMS Audit answers do. The old columns are left exactly as they are,
     * so every review recorded before today still reads back in full.
     */
    public function up()
    {
        // one row per answered question; 'A' is the decisions box in Part 3
        if (!Schema::hasTable('tbl_mgtreview_answers')) {
            Schema::create('tbl_mgtreview_answers', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('mgtreview_id')->index();
                $table->string('question_no', 4);
                $table->text('answer')->nullable();
                $table->string('evidence_file', 255)->nullable();
                $table->timestamps();
                $table->unique(['mgtreview_id', 'question_no'], 'mgtreview_answer_unique');
            });
        }

        // Part 3 C: who will do what, and by when
        if (!Schema::hasTable('tbl_mgtreview_actions')) {
            Schema::create('tbl_mgtreview_actions', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('mgtreview_id')->index();
                $table->text('action');
                $table->string('who', 255)->nullable();
                $table->date('by_when')->nullable();
                $table->boolean('done')->default(false);
                $table->timestamps();
            });
        }

        // Part 3 D: the minutes, slides, photos or video. Several per review,
        // so the single attach_file column could not hold them.
        if (!Schema::hasTable('tbl_mgtreview_files')) {
            Schema::create('tbl_mgtreview_files', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('mgtreview_id')->index();
                $table->string('file', 255);
                $table->string('original_name', 255)->nullable();
                $table->timestamps();
            });
        }

        // who chaired it, and when the next one is due
        if (Schema::hasTable('tbl_mgtreviews')) {
            Schema::table('tbl_mgtreviews', function (Blueprint $table) {
                if (!Schema::hasColumn('tbl_mgtreviews', 'chairedby')) {
                    $table->string('chairedby', 255)->nullable()->after('reviewdate');
                }
                if (!Schema::hasColumn('tbl_mgtreviews', 'nextreviewdue')) {
                    $table->string('nextreviewdue', 255)->nullable()->after('meetingatt');
                }
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('tbl_mgtreview_files');
        Schema::dropIfExists('tbl_mgtreview_actions');
        Schema::dropIfExists('tbl_mgtreview_answers');
        if (Schema::hasTable('tbl_mgtreviews')) {
            Schema::table('tbl_mgtreviews', function (Blueprint $table) {
                if (Schema::hasColumn('tbl_mgtreviews', 'chairedby'))     $table->dropColumn('chairedby');
                if (Schema::hasColumn('tbl_mgtreviews', 'nextreviewdue')) $table->dropColumn('nextreviewdue');
            });
        }
    }
};
