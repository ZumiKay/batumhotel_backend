<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('booking' , function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('roomname');
            $table->string('amount')->default('1');
            $table->string('image');
            $table->string('price');
            $table->string('totalprice');
            $table->string('guests');
            $table->string('checkin')->default(date("Y-m-d H:i:s"));
            $table->string('checkout')->default(date("Y-m-d H:i:s"));
            $table->string('extras')->nullable();
            $table->string('status')->default('not yet checkin');
            $table->bigInteger('user_id');
            $table->string('roomid');
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
        Schema::dropIfExists('booking');
    }
}
