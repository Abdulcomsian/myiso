<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * New Health & Safety and Environmental objectives on Management Reviews.
     */
    public function up()
    {
        Schema::table('tbl_mgtreviews', function (Blueprint $table) {
            if (!Schema::hasColumn('tbl_mgtreviews', 'newhealthsafety')) {
                $table->text('newhealthsafety')->nullable()->after('newquality');
            }
            if (!Schema::hasColumn('tbl_mgtreviews', 'newenvironmental')) {
                $table->text('newenvironmental')->nullable()->after('newhealthsafety');
            }
        });
    }

    public function down()
    {
        Schema::table('tbl_mgtreviews', function (Blueprint $table) {
            $table->dropColumn(['newhealthsafety', 'newenvironmental']);
        });
    }
};
