<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Environmental Impacts, Hazards (Health & Safety) and Incident & Injury registers.
     */
    public function up()
    {
        if (!Schema::hasTable('tbl_environmental_impacts')) {
            Schema::create('tbl_environmental_impacts', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->index();
                $table->string('aspect');
                $table->string('impact');
                $table->string('controls');
                $table->string('responsible_person')->nullable();
                $table->string('monitoring_method')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('tbl_hazards')) {
            Schema::create('tbl_hazards', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->index();
                $table->string('hazard');
                $table->string('risk');
                $table->string('controls');
                $table->string('responsible_person')->nullable();
                $table->string('monitoring_method')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('tbl_incidents')) {
            Schema::create('tbl_incidents', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->index();
                $table->date('incident_date');
                $table->text('description');
                $table->string('injured_person');
                $table->string('severity', 20);
                $table->string('location');
                $table->text('first_aid')->nullable();
                $table->string('witnesses')->nullable();
                $table->text('investigation')->nullable();
                $table->text('corrective_actions')->nullable();
                $table->string('status', 20)->default('open');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('tbl_incidents');
        Schema::dropIfExists('tbl_hazards');
        Schema::dropIfExists('tbl_environmental_impacts');
    }
};
