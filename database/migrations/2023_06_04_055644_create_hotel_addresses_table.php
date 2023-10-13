<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description', 255)->nullable();
            $table->string('address', 255);
            $table->double('latitude', 20, 17)->default(0);
            $table->double('longitude', 20, 17)->default(0);
            $table->boolean('default')->nullable()->default(0);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_addresses');
    }
}
