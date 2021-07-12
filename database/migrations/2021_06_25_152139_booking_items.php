<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BookingItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookingitems' , function (Blueprint $table){
            $table->id();
            $table->string('roomname');
            $table->string('price');
            $table->string('Adult');
            $table->string('Child');
            $table->string('amounts');
            $table->string('image');
            $table->integer('user_id');
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
        //
    }
}
