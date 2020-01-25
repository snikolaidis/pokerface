<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $rank;
    protected $color;
    public static $rankValues = [
        "2" => 1,
        "3" => 2,
        "4" => 3,
        "5" => 4,
        "6" => 5,
        "7" => 6,
        "8" => 7,
        "9" => 8,
        "T" => 9,
        "J" => 10,
        "Q" => 11,
        "K" => 12,
        "A" => 13,
    ];

    public function __construct($card)
    {
        $this->rank = substr($card, 0, 1);
        $this->color = substr($card, 1, 1);
    }

    public function toString() {
        return $this->rank . $this->color;
    }

    public function getRank() {
        return $this->rank . '';
    }

    public function getRankValue() {
        return $this->getTheRankOf($this->rank);
    }

    public static function getTheRankOf($rank) {
        if (isset(Card::$rankValues[$rank])) {
            return Card::$rankValues[$rank];
        } else {
            return 0;
        }
    }

    public function getColor() {
        return $this->color;
    }
}
