<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poker_games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('player_a_1')->default("");
            $table->string('player_a_2')->default("");
            $table->string('player_a_3')->default("");
            $table->string('player_a_4')->default("");
            $table->string('player_a_5')->default("");
            $table->string('player_b_1')->default("");
            $table->string('player_b_2')->default("");
            $table->string('player_b_3')->default("");
            $table->string('player_b_4')->default("");
            $table->string('player_b_5')->default("");
            $table->integer('winner')->default(0)->index();
            $table->integer('winning_type')->default(0)->index();
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
        Schema::dropIfExists('poker_games');
    }
}
