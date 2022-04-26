<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->boolean('game_started');
            $table->bigInteger('game_play_id')->unsigned()->nullable();
            $table->string('name');
            $table->bigInteger('user_1')->unsigned()->nullable();
            $table->bigInteger('user_2')->unsigned()->nullable();
            $table->bigInteger('user_3')->unsigned()->nullable();
            $table->bigInteger('user_4')->unsigned()->nullable();
            $table->timestamps();
        });
        Schema::table('rooms',function (Blueprint $table){
            $table->foreign('user_1')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_2')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_3')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_4')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
