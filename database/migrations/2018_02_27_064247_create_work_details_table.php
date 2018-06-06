<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('work_details')){
        Schema::create('work_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('generatedid',10)->unique();
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname')->nullable();
            $table->string('contact', 10);
            $table->integer('worktypeid')->unsigned();
            $table->text('description')->nullable();
            $table->date('startdate');
            $table->date('enddate')->nullable();
            $table->date('deletedate');
            $table->integer('hours')->nullable();
            $table->integer('paymentperhour')->nullable();
            $table->BOOLEAN('workstatus')->default(0);
            $table->foreign('worktypeid')->references('id')->on('work_type')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('work_details');
    }
}
