<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The QMS Audit moved from 29 ISO clauses to the client's 17 questions.
     *
     * The answers go in a table of their own rather than into more columns on
     * tbl_qmsaudit: that table already carries 70, one pair per old clause, and
     * the questions are expected to be reworded again. A row per answer also
     * leaves the old records untouched and still readable.
     */
    public function up()
    {
        if (!Schema::hasTable('tbl_qmsaudit_answers')) {
            Schema::create('tbl_qmsaudit_answers', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('qmsaudit_id')->index();
                $table->unsignedSmallInteger('question_no');
                $table->string('answer', 8)->nullable();        // Yes / No / NA
                $table->text('note')->nullable();               // the evidence note
                $table->string('evidence_file', 255)->nullable();
                $table->timestamps();
                $table->unique(['qmsaudit_id', 'question_no'], 'qmsaudit_answer_unique');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('tbl_qmsaudit_answers');
    }
};
