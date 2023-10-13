<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingRuleAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_rule_address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipping_rule_id');
            $table->unsignedBigInteger('address_id');
            $table->timestamps();

            // $table->foreign('shipping_rule_id')->references('id')->on('shipping_rules')->onDelete('cascade');
            // $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_rule_address');
    }
}
