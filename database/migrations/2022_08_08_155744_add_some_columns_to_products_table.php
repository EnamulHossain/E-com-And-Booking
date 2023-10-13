<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('offer_price')->after('description');
            $table->dateTime('offer_start')->nullable()->after('offer_price');
            $table->dateTime('offer_end')->nullable()->after('offer_start');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('offer_price');
            $table->dropColumn('offer_start');
            $table->dropColumn('offer_end');
        });
    }
}