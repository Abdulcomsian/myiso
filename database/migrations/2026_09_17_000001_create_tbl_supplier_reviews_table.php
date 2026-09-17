<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Supplier Reviews (same fields as tbl_customer_reviews, keyed by supplier ID number).
     */
    public function up()
    {
        if (Schema::hasTable('tbl_supplier_reviews')) {
            return;
        }

        Schema::create('tbl_supplier_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('sup_id')->nullable();
            $table->string('product_activity_area', 200)->nullable();
            $table->string('qualityScore');
            $table->string('priceScore');
            $table->string('DScore');
            $table->string('OveralScore');
            $table->string('AssesmentDate');
            $table->text('other_issues')->nullable();
            $table->string('attach_evidence')->nullable();
            $table->timestamps();

            $table->index('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_supplier_reviews');
    }
};
