<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalculatePlayerScoreTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExampleTest()
    {
        $pokerGame = new \App\Http\Controllers\PokerGameController();

        // Royal Flush
        $player = new \App\Player(['JD','QD','TD','KD','AD']);
        $score = $pokerGame->calculateScore($player);
        $this->assertEquals($score["score"], 1000);
        
        // Straight Flush
        $player = new \App\Player(['JD','QD','TD','KD','9D']);
        $score = $pokerGame->calculateScore($player);
        $this->assertEquals($score["score"], 900);
        
        // Four of a kind
        $player = new \App\Player(['AD','AH','AC','AR','9D']);
        $score = $pokerGame->calculateScore($player);
        $this->assertEquals($score["score"], 800);
        
        // Full House
        $player = new \App\Player(['AD','AH','TC','TR','TD']);
        $score = $pokerGame->calculateScore($player);
        $this->assertEquals($score["score"], 700);

        // Flush
        $player = new \App\Player(['AD','6D','8D','TD','2D']);
        $score = $pokerGame->calculateScore($player);
        $this->assertEquals($score["score"], 600);

        // Straight
        $player = new \App\Player(['JH','QD','TR','KD','9D']);
        $score = $pokerGame->calculateScore($player);
        $this->assertEquals($score["score"], 500);

        // Three of a Kind
        $player = new \App\Player(['AD','6H','TC','TR','TD']);
        $score = $pokerGame->calculateScore($player);
        $this->assertEquals($score["score"], 400);

        // Two Pair
        $player = new \App\Player(['AD','AH','TC','TR','6D']);
        $score = $pokerGame->calculateScore($player);
        $this->assertEquals($score["score"], 300);

        // Two Pair
        $player = new \App\Player(['AD','8H','TC','TR','6D']);
        $score = $pokerGame->calculateScore($player);
        $this->assertEquals($score["score"], 200);
    }
}
