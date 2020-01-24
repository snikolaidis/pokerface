<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $cards;

    public function __construct($listOfCards) {
        $this->cards = $listOfCards;
    }
}
