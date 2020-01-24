<?php

namespace App;

use App\Http\Controllers\PokerGameController;
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

        $player_A = new PLayer([$arrayOfCards[0], $arrayOfCards[1], $arrayOfCards[2], $arrayOfCards[3], $arrayOfCards[4]]);
        $player_B = new PLayer([$arrayOfCards[5], $arrayOfCards[6], $arrayOfCards[7], $arrayOfCards[8], $arrayOfCards[9]]);

        $this->player_a_1 = $player_A->getCards()[0]->toString();
        $this->player_a_2 = $player_A->getCards()[1]->toString();
        $this->player_a_3 = $player_A->getCards()[2]->toString();
        $this->player_a_4 = $player_A->getCards()[3]->toString();
        $this->player_a_5 = $player_A->getCards()[4]->toString();
        $this->player_b_1 = $player_B->getCards()[0]->toString();
        $this->player_b_2 = $player_B->getCards()[1]->toString();
        $this->player_b_3 = $player_B->getCards()[2]->toString();
        $this->player_b_4 = $player_B->getCards()[3]->toString();
        $this->player_b_5 = $player_B->getCards()[4]->toString();

        $this->calculateTheWinner($player_A, $player_B);
    }

    public function calculateTheWinner(Player $player_A, Player $player_B) {
        $pokerGameContoller = new PokerGameController();
        $gameResult = $pokerGameContoller->getTheWinner($player_A, $player_B);
        
        $this->winner = $gameResult['winner'];
        $this->winning_type = $gameResult['winning_type'];
        $this->winning_descr = $gameResult['descr'];
    }
}


/* Tinker Test
$game = new \App\PokerGame(); $game->addListOfCards("8C TS KC 9H 4S 7D 2S 5D 3S AC");
$game->save();
$game->player_a_1 = "8C";
*/
