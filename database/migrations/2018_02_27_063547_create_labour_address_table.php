<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabourAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('labour_address')){
        Schema::create('labour_address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('labourid')->unsigned();
            $table->integer('stateid')->unsigned();
            $table->integer('cityid')->unsigned();
            $table->integer('areaid')->unsigned();
            $table->integer('pincode');
            $table->foreign('labourid')->references('id')->on('labour_details')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('stateid')->references('id')->on('state')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cityid')->references('id')->on('city')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('areaid')->references('id')->on('area')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }
  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labour_address');
    }
}
