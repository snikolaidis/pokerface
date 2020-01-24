<?php

namespace App\Http\Controllers;

use App\Card;
use App\PokerGame;
use Illuminate\Http\Request;

class PokerGameController extends Controller
{
    protected $player_A_cards;
    protected $player_B_cards;

    public function doTheMath(PokerGame $pokerGame) {

        // So, in case something goes wrong, we have the default value: draw
        $pokerGame->winner = 0;
        $pokerGame->winning_type = 0;

        // And let's group the cards into two arrays
        $this->player_A_cards = [];
        $this->player_A_cards[] = new Card($pokerGame->player_a_1);
        $this->player_A_cards[] = new Card($pokerGame->player_a_2);
        $this->player_A_cards[] = new Card($pokerGame->player_a_3);
        $this->player_A_cards[] = new Card($pokerGame->player_a_4);
        $this->player_A_cards[] = new Card($pokerGame->player_a_5);

        $this->player_B_cards = [];
        $this->player_B_cards[] = new Card($pokerGame->player_b_1);
        $this->player_B_cards[] = new Card($pokerGame->player_b_2);
        $this->player_B_cards[] = new Card($pokerGame->player_b_3);
        $this->player_B_cards[] = new Card($pokerGame->player_b_4);
        $this->player_B_cards[] = new Card($pokerGame->player_b_5);

        $this->sortTheCards();

        // Now it's time to do the analysis for the cards.
        $score_A = $this->getScoreForPlayer($this->player_A_cards);
        $score_B = $this->getScoreForPlayer($this->player_B_cards);

        var_dump($score_A);
        // var_dump($score_B);
    }

    private function areCardsOfTheSameColor($listOfCards) {
        return ($listOfCards[0]->getColor() == $listOfCards[1]->getColor()) &&
            ($listOfCards[0]->getColor() == $listOfCards[2]->getColor()) &&
            ($listOfCards[0]->getColor() == $listOfCards[3]->getColor()) &&
            ($listOfCards[0]->getColor() == $listOfCards[4]->getColor());
    }

    private function areCardsInSequence($listOfCards) {
        return
            $listOfCards[0]->getRankValue() == ($listOfCards[1]->getRankValue() - 1) &&
            $listOfCards[1]->getRankValue() == ($listOfCards[2]->getRankValue() - 1) &&
            $listOfCards[2]->getRankValue() == ($listOfCards[3]->getRankValue() - 1) &&
            $listOfCards[3]->getRankValue() == ($listOfCards[4]->getRankValue() - 1);
    }

    private function getScoreForPlayer($listOfCards) {

        if ($this->areCardsOfTheSameColor($listOfCards) && $listOfCards[0]->getRankValue() == 9) {
            return [
                "score" => 1000,
                "type" => 100,
                "descr" => "Royal Flush",
            ];
        } elseif ($this->areCardsOfTheSameColor($listOfCards) && $this->areCardsInSequence($listOfCards)) {
            return [
                "score" => 900,
                "type" => 90,
                "descr" => "Straight Flush",
            ];
        } elseif (
            ($listOfCards[0]->getRankValue() == $listOfCards[1]->getRankValue() &&
            $listOfCards[0]->getRankValue() == $listOfCards[2]->getRankValue() &&
            $listOfCards[0]->getRankValue() == $listOfCards[3]->getRankValue()) ||
            ($listOfCards[4]->getRankValue() == $listOfCards[1]->getRankValue() &&
            $listOfCards[4]->getRankValue() == $listOfCards[2]->getRankValue() &&
            $listOfCards[4]->getRankValue() == $listOfCards[3]->getRankValue())
        ) {
            return [
                "score" => 800,
                "type" => 80,
                "descr" => "Four of a kind",
            ];
        } elseif (
            (!$this->areCardsOfTheSameColor($listOfCards)) &&
            ($listOfCards[0]->getRankValue() == $listOfCards[1]->getRankValue()) &&
            ($listOfCards[3]->getRankValue() == $listOfCards[4]->getRankValue()) &&
            ($listOfCards[1]->getRankValue() == $listOfCards[2]->getRankValue() || $listOfCards[2]->getRankValue() == $listOfCards[3]->getRankValue())
        ) {
            return [
                "score" => 700,
                "type" => 70,
                "descr" => "Full House",
            ];
        } elseif ($this->areCardsOfTheSameColor($listOfCards)) {
            return [
                "score" => 600,
                "type" => 60,
                "descr" => "Flush",
            ];
        } elseif ($this->areCardsInSequence($listOfCards)) {
            return [
                "score" => 500,
                "type" => 50,
                "descr" => "Straight",
            ];
        } elseif (
            ($listOfCards[0]->getRankValue() == $listOfCards[1]->getRankValue() && $listOfCards[0]->getRankValue() == $listOfCards[2]->getRankValue()) ||
            ($listOfCards[1]->getRankValue() == $listOfCards[2]->getRankValue() && $listOfCards[1]->getRankValue() == $listOfCards[3]->getRankValue()) ||
            ($listOfCards[2]->getRankValue() == $listOfCards[3]->getRankValue() && $listOfCards[2]->getRankValue() == $listOfCards[4]->getRankValue())
        ) {
            return [
                "score" => 400,
                "type" => 40,
                "descr" => "Three of a Kind",
            ];
        } elseif (
            $listOfCards[0]->getRankValue() == $listOfCards[1]->getRankValue() && (
                $listOfCards[2]->getRankValue() == $listOfCards[3]->getRankValue() ||
                $listOfCards[3]->getRankValue() == $listOfCards[4]->getRankValue()
            ) || 
            (
                $listOfCards[1]->getRankValue() == $listOfCards[2]->getRankValue() &&
                $listOfCards[3]->getRankValue() == $listOfCards[4]->getRankValue()
            )
        ) {
            return [
                "score" => 300,
                "type" => 30,
                "descr" => "Two pair",
            ];
        } elseif (
            $listOfCards[0]->getRankValue() == $listOfCards[1]->getRankValue() ||
            $listOfCards[1]->getRankValue() == $listOfCards[2]->getRankValue() ||
            $listOfCards[2]->getRankValue() == $listOfCards[3]->getRankValue() ||
            $listOfCards[3]->getRankValue() == $listOfCards[4]->getRankValue()
        ) {
            return [
                "score" => 200,
                "type" => 20,
                "descr" => "One pair",
            ];
        } else {
            return [
                "score" => $listOfCards[4]->getRankValue(),
                "type" => 10,
                "descr" => "High Card",
            ];
        }
    }

    private function sortTheCardsFunc($a,$b) {
        $rank_a = $a->getRankValue();
        $rank_b = $b->getRankValue();

        if ($rank_a == $rank_b) {
            return 0;
        } elseif ($rank_a > $rank_b) {
            return 1;
        } else {
            return -1;
        }
    }
 
    public function sortTheCards() {
        
        // Let's sort player's A cards
        $array = array();
        foreach ($this->player_A_cards as $k => $v) {
            $array[$k] = clone $v;
        }
        usort($array, array($this,'sortTheCardsFunc'));
        
        $this->player_A_cards = array();
        foreach ($array as $k => $v) {
            $this->player_A_cards[$k] = clone $v;
        }

        // Let's sort player's B cards
        $array = array();
        foreach ($this->player_B_cards as $k => $v) {
            $array[$k] = clone $v;
        }
        usort($array, array($this,'sortTheCardsFunc'));
        
        $this->player_B_cards = array();
        foreach ($array as $k => $v) {
            $this->player_B_cards[$k] = clone $v;
        }
    }
}
