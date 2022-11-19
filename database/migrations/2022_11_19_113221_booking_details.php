<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BookingDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('booking_id');
            $table->string('airlines_type');
            $table->string('airport_city_from');
            $table->string('airport_city_to');
            $table->string('airport_country_from');
            $table->string('airport_country_to');
            $table->string('airport_name_from');
            $table->string('airport_name_to');
            $table->string('flight_departure');
            $table->string('flight_arrival');
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
        Schema::dropIfExists('booking_details');
    }
}
