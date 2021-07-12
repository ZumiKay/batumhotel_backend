<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HotelList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HotelList' , function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('type')->nullable();
            $table->integer('price');
            $table->string('featured')->nullable();
            $table->string('preview')->nullable();
            $table->string('Adult');
            $table->string('Child');
            $table->text('description');
            $table->string('extras')->nullable();
            $table->string('image');
            $table->string('image1');
            $table->string('image2');
            $table->string('image3');
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
        Schema::dropIfExists('HotelList');
    }
}
