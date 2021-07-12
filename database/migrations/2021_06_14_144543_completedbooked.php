<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Completedbooked extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('completedbooked' , function (Blueprint $table){
            $table->id();
            $table->string('roomname');
            $table->string('image');
            $table->string('amount');
            $table->string('checkin')->default(date("Y-m-d H:i:s"));
            $table->string('checkout')->default(date("Y-m-d H:i:s"));
            $table->string('price');
            $table->string('status');
            $table->bigInteger('user_id');
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
