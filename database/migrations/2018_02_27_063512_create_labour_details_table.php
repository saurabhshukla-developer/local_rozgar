<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabourDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('labour_details')){
        Schema::create('labour_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('adhar',16)->unique();
            $table->string('fname',20);
            $table->string('mname',20)->nullable();
            $table->string('lname',20)->nullable();
            $table->string('contact',10);
            $table->integer('age');
            $table->enum('gender',['male','female']);
            $table->integer('labourtypeid')->unsigned();
            $table->BOOLEAN('flag')->default(0);
            $table->foreign('labourtypeid')->references('id')->on('labour_type')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }
   DB::statement('ALTER TABLE labour_details ADD CONSTRAINT chk_age CHECK(age>18);');
   
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labour_details');
    }
}
