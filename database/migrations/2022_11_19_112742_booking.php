<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Booking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('users_id');
            $table->string('booking_id');
            $table->string('noofpassenger');
            $table->string('phone_country_code');
            $table->string('phone_number');
            $table->string('email_id');
            $table->string('whatsup_status');
            $table->string('amount');
            $table->string('aborted_status');
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
        Schema::dropIfExists('bookings');
    }
}
