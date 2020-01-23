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
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('player_a_1');
            $table->string('player_a_2');
            $table->string('player_a_3');
            $table->string('player_a_4');
            $table->string('player_a_5');
            $table->string('player_b_1');
            $table->string('player_b_2');
            $table->string('player_b_3');
            $table->string('player_b_4');
            $table->string('player_b_5');
            $table->integer('winner')->index();
            $table->integer('winning_type')->index();
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
        Schema::dropIfExists('games');
    }
}
