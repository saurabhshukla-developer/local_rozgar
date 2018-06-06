<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('work_address')){
        Schema::create('work_address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workid')->unsigned();
            $table->string('hno',10)->nullable();
            $table->string('locality', 30)->nullable();
            $table->integer('stateid')->unsigned();
            $table->integer('cityid')->unsigned();
            $table->integer('areaid')->unsigned();
            $table->unsignedInteger('pincode');
            $table->foreign('workid')->references('id')->on('work_details')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('work_address');
    }
}
