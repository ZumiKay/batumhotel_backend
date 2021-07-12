<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Storeamounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('storeamount', function (Blueprint $table)
        {
            $table->id();
            $table->string('amount');
            $table->integer('user_id');
            $table->string('roomid');
            $table->timestamps();
        });;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('storeamount');
    }
}
