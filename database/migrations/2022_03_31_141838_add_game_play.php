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
        Schema::create('game_play',function ($table) {
            $table->id();
            $table->bigInteger('player_1')->unsigned();
            $table->bigInteger('player_2')->unsigned();
            $table->bigInteger('player_3')->unsigned()->nullable();
            $table->bigInteger('player_4')->unsigned()->nullable();
            $table->bigInteger('current_player')->unsigned();
            $table->integer('rabbits');
            $table->integer('sheep');
            $table->integer('pigs');
            $table->integer('cows');
            $table->integer('horses');
            $table->integer('small_dogs');
            $table->integer('big_dogs');
            $table->timestamps();
        });
        Schema::table('game_play',function (Blueprint $table){
            $table->foreign('player_1')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('player_2')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('player_3')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('player_4')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('current_player')->references('id')->on('players')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('game_play');
    }
};
