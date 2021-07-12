<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Paymentfee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('payment', function(Blueprint $table){
            $table->id();
            $table->string('cardnumber');
            $table->string('cardholder');
            $table->string('cvv');
            $table->string('expire');
            $table->integer('user_id');
            $table->string('status');
            $table->string('cash');
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
        Schema::dropIfExists('payment');
    }
}
