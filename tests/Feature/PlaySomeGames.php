<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlaySomeGamesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $game = new \App\PokerGame();
        $game->addListOfCards('8C TS KC 9H 4S 7D 2S 5D 3S AC');
        $this->assertEquals($game->winning_type, 10);
        $this->assertEquals($game->winning_descr, "High Card");
    }
}
