<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PokerGame extends Model
{
    /**
     * The basic function which gets a list of 10 cards and prepares all the data.
     * @param mixed $listOfCards 
     * @return void 
     */
    public function addListOfCards($listOfCards) {
        $arrayOfCards = explode(" ", $listOfCards);
        if (sizeof($arrayOfCards) != 10) {
            return false;
        }

        $this->player_a_1 = $arrayOfCards[0];
        $this->player_a_2 = $arrayOfCards[1];
        $this->player_a_3 = $arrayOfCards[2];
        $this->player_a_4 = $arrayOfCards[3];
        $this->player_a_5 = $arrayOfCards[4];
        $this->player_b_1 = $arrayOfCards[5];
        $this->player_b_2 = $arrayOfCards[6];
        $this->player_b_3 = $arrayOfCards[7];
        $this->player_b_4 = $arrayOfCards[8];
        $this->player_b_5 = $arrayOfCards[9];

        // Guess the Winner
        return true;
    }
}


/* Tinker Test
$game = new \App\PokerGame();
$game->addListOfCards("8C TS KC 9H 4S 7D 2S 5D 3S AC");
$game->save();
$game->player_a_1 = "8C";
*/
