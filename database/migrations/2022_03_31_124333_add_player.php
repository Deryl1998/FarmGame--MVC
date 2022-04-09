<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players',function ($table){
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('rabbits');
            $table->integer('sheep');
            $table->integer('pigs');
            $table->integer('cows');
            $table->integer('horses');
            $table->integer('small_dogs');
            $table->integer('big_dogs');
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
        Schema::drop('players');
    }
};
