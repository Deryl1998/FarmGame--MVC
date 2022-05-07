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
            $table->bigInteger('user')->unsigned()->nullable();
            $table->integer('rabbits');
            $table->integer('sheep');
            $table->integer('pigs');
            $table->integer('cows');
            $table->integer('horses');
            $table->integer('small_dogs');
            $table->integer('big_dogs');
            $table->boolean('round');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
        Schema::table('players',function (Blueprint $table){
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
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
