<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('city')){
        Schema::create('city', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stateid')->unsigned();
            $table->string('cityname',20);
            $table->unique(['stateid','cityname']);
            $table->foreign('stateid')->references('id')->on('state')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('city');
    }
}
