<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Registers: only the first field stays required, the rest become optional.
     */
    public function up()
    {
        Schema::table('tbl_environmental_impacts', function (Blueprint $table) {
            $table->string('impact')->nullable()->change();
            $table->string('controls')->nullable()->change();
        });

        Schema::table('tbl_hazards', function (Blueprint $table) {
            $table->string('risk')->nullable()->change();
            $table->string('controls')->nullable()->change();
        });

        Schema::table('tbl_incidents', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
            $table->string('injured_person')->nullable()->change();
            $table->string('severity', 20)->nullable()->change();
            $table->string('location')->nullable()->change();
            $table->string('status', 20)->nullable()->default('open')->change();
        });
    }

    public function down()
    {
        Schema::table('tbl_environmental_impacts', function (Blueprint $table) {
            $table->string('impact')->nullable(false)->change();
            $table->string('controls')->nullable(false)->change();
        });

        Schema::table('tbl_hazards', function (Blueprint $table) {
            $table->string('risk')->nullable(false)->change();
            $table->string('controls')->nullable(false)->change();
        });

        Schema::table('tbl_incidents', function (Blueprint $table) {
            $table->text('description')->nullable(false)->change();
            $table->string('injured_person')->nullable(false)->change();
            $table->string('severity', 20)->nullable(false)->change();
            $table->string('location')->nullable(false)->change();
            $table->string('status', 20)->nullable(false)->default('open')->change();
        });
    }
};
