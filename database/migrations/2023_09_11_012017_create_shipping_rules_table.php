<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_rules', function (Blueprint $table) {
            $table->id();
            $table->json('shipping_companies_id');
            $table->json('address_id');
            $table->integer('price_for_location');
            // $table->integer('weight');
            // $table->integer('price_for_weight');
            $table->timestamps();
            // $table->foreign('shipping_companies_id')->references('id')->on('shipping_companies');
            // $table->foreign('address_id')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_rules');
    }
}
