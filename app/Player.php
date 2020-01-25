<?php

namespace App;

use App\Http\Controllers\PokerGameController;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $cards;

    // Temp tables
    protected $ranksInArray;
    protected $colorsInArray;

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
 
    /**
     * By default, when we create a player with a list of cards, it automatically sorts the cards based
     * on each rank's value.
     */
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

    private function sortTheRanksFunc($a,$b) {
        if ($this->ranksInArray[$a]['count'] != $this->ranksInArray[$b]['count']) {
            return $this->ranksInArray[$a]['count'] < $this->ranksInArray[$b]['count'] ? 1 : -1;
        } else {
            return Card::getTheRankOf($a) < Card::getTheRankOf($b) ? 1 : -1;
        }
    }

    /**
     * This function returns an array of the cards, in a specific format which helps the PokerGameController
     * to analyze and find the winner. So, if the player had the following cards on this had:
     * 
     * 'AD','AH','TC','TR','TD'
     * 
     * The final result would be the following:
     * 
     * [
     *    "ranks" => ["T" => 3, "A" => 2],
     *   "colors" => ["D" => 3, "H" => 1, "C" => 1, "R" => 1]
     * ]
     * 
     * @return array[] 
     */
    public function getArrayOfCards() {
        $this->ranksInArray = [];
        $this->colorsInArray = [];

        foreach ($this->cards as $key => $card) {
            if (isset($this->ranksInArray[$card->getRank()])) {
                $this->ranksInArray[$card->getRank()]['count'] += 1;
            } else {
                $this->ranksInArray[$card->getRank()] = [
                    'count' => 1,
                    'value' => $card->getRankValue(),
                ];
            }
            uksort($this->ranksInArray, array($this,'sortTheRanksFunc'));

            if (isset($this->colorsInArray[$card->getColor()])) {
                $this->colorsInArray[$card->getColor()] += 1;
            } else {
                $this->colorsInArray[$card->getColor()] = 1;
            }
            arsort($this->colorsInArray);
        }

        $finalArray = [
            "ranks" => [],
            "colors" => $this->colorsInArray,
        ];
        foreach ($this->ranksInArray as $key => $value) {
            $finalArray["ranks"][$key] = $value["count"];
        }
        
        return $finalArray;
    }
}
