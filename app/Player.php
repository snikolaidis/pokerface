<?php

namespace App;

use App\Http\Controllers\PokerGameController;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $cards;

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
 
    public function __construct($listOfCards) {
        $orderedListOfCards = array();
        foreach ($listOfCards as $key => $card) {
            $orderedListOfCards[] = new Card($card);
        }
        usort($orderedListOfCards, array($this,'sortTheCardsFunc'));

        $this->cards = [];
        foreach ($orderedListOfCards as $key => $card) {
            $this->cards[] = $card;
        }
    }

    public function getScore() {
        $pokerGameController = new PokerGameController();
        return $pokerGameController->calculateScore($this);
    }

    public function getCards() {
        return $this->cards;
    }
}
