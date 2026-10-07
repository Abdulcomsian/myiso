<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Objectives Tracker.
     *
     * An objective is agreed at a Management Review and then tracked through
     * the year. Each progress note is a row of its own in tbl_objective_updates
     * rather than a column that gets overwritten, because the whole point is
     * that an auditor can see the history.
     *
     * Short keys are stored for the status, so the English and Arabic sites can
     * each word it their own way.
     */
    public function up()
    {
        if (!Schema::hasTable('tbl_objectives')) {
            Schema::create('tbl_objectives', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->index();
                $table->string('objective', 500);
                $table->string('how_measured', 500);
                $table->string('starting_point', 255)->nullable();
                $table->string('target', 255);
                $table->text('how_achieved')->nullable();
                $table->string('person_responsible', 255)->nullable();   // an employee
                $table->integer('agreed_at')->nullable();                // a management review
                $table->date('deadline')->nullable();
                $table->string('status', 32)->default('not_started');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('tbl_objective_updates')) {
            Schema::create('tbl_objective_updates', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('objective_id')->index();
                $table->integer('user_id')->index();
                $table->text('note');
                $table->string('status', 32);
                $table->date('update_date')->nullable();
                $table->string('evidence', 255)->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('tbl_objective_updates');
        Schema::dropIfExists('tbl_objectives');
    }
};
