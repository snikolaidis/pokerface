<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $rank;
    protected $color;
    protected $rankValues;

    public function __construct($card)
    {
        $this->rankValues = [
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

        $this->rank = substr($card, 0, 1);
        $this->color = substr($card, 1, 1);
    }

    public function toString() {
        return $this->rank . $this->color;
    }

    public function getRank() {
        return $this->rank;
    }

    public function getRankValue() {
        if (isset($this->rankValues[$this->rank])) {
            return $this->rankValues[$this->rank];
        } else {
            return 0;
        }
    }

    public function getColor() {
        return $this->color;
    }
}
