<?php

namespace App\Http\Controllers;

use App\Card;
use App\Player;
use App\PokerGame;
use Illuminate\Http\Request;

class PokerGameController extends Controller
{
    protected $player_A_cards;
    protected $player_B_cards;

    /**
     * Implementing basic auth access.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function calculateScore(Player $player) {
        // return $this->getScoreForPlayer_v1($player->getCards());
        return $this->getScoreForPlayer_v2($player->getArrayOfCards());
    }

    public function getTheWinner(Player $player_A, Player $player_B) {

        $score_A = $player_A->getScore();
        $score_B = $player_B->getScore();

        if ($score_A['score'] > $score_B['score']) {
            $gameResult = [
                'winner' => 1,
                'winning_type' => $score_A['type'],
                'descr' => $score_A['descr'],
            ];
        } elseif ($score_A['score'] < $score_B['score']) {
            $gameResult = [
                'winner' => 2,
                'winning_type' => $score_B['type'],
                'descr' => $score_B['descr'],
            ];
        } else {
            $gameResult = [
                'winner' => 0,
                'winning_type' => $score_A['type'],
                'descr' => $score_A['descr'],
            ];

            // For the testing purposes only, we have the case of "one pair" here we have ties. In this case
            // we need to calculate the higher pair value:
            if ($score_A['score'] == 200) {
                $cards_A = $player_A->getCards();
                $player_A_rank = $cards_A[0]->getRankValue() == $cards_A[1]->getRankValue() ? $cards_A[0]->getRankValue() :
                                ($cards_A[1]->getRankValue() == $cards_A[2]->getRankValue() ? $cards_A[1]->getRankValue() :
                                ($cards_A[2]->getRankValue() == $cards_A[3]->getRankValue() ? $cards_A[2]->getRankValue() :
                                $cards_A[3]->getRankValue()));
                $cards_B = $player_B->getCards();
                $player_B_rank = $cards_B[0]->getRankValue() == $cards_B[1]->getRankValue() ? $cards_B[0]->getRankValue() :
                                ($cards_B[1]->getRankValue() == $cards_B[2]->getRankValue() ? $cards_B[1]->getRankValue() :
                                ($cards_B[2]->getRankValue() == $cards_B[3]->getRankValue() ? $cards_B[2]->getRankValue() :
                                $cards_B[3]->getRankValue()));

                $gameResult['winner'] = $player_A_rank > $player_B_rank ? 1 : 2;
            }
        }

        return $gameResult;
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

    /**
     * This is the 1st version of calculating the scores. It was a very primitive first approach.
     * Quite hard to read and follow.
     * 
     * @param mixed $listOfCards 
     * @return array 
     */
    private function getScoreForPlayer_v1($listOfCards) {

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

    /**
     * The 2nd version of the score caclulation. Better use of arrays and easier to follow. Much more elegant.
     * 
     * @param mixed $listOfCards 
     * @return (int|string)[] 
     */
    private function getScoreForPlayer_v2($listOfCards) {

        if (
            sizeof($listOfCards["colors"]) == 1 &&
            array_key_last($listOfCards["ranks"]) == "T"
        ) {
            return [
                "score" => 1000,
                "type" => 100,
                "descr" => "Royal Flush",
            ];
        } elseif (
            sizeof($listOfCards["colors"]) == 1 &&
            Card::getTheRankOf(array_keys($listOfCards["ranks"])[0]) - Card::getTheRankOf(array_keys($listOfCards["ranks"])[4]) == 4
        ) {
            return [
                "score" => 900,
                "type" => 90,
                "descr" => "Straight Flush",
            ];
        } elseif (
            sizeof($listOfCards["colors"]) == 4 &&
            $listOfCards["ranks"][array_keys($listOfCards["ranks"])[0]] == 4
        ) {
            return [
                "score" => 800,
                "type" => 80,
                "descr" => "Four of a kind",
            ];
        } elseif (
            sizeof($listOfCards["colors"]) > 2 &&
            $listOfCards["ranks"][array_keys($listOfCards["ranks"])[0]] == 3 &&
            $listOfCards["ranks"][array_keys($listOfCards["ranks"])[1]] == 2
        ) {
            return [
                "score" => 700,
                "type" => 70,
                "descr" => "Full House",
            ];
        } elseif (
            sizeof($listOfCards["colors"]) == 1
        ) {
            return [
                "score" => 600,
                "type" => 60,
                "descr" => "Flush",
            ];
        } elseif (
            sizeof($listOfCards["ranks"]) == 5 &&
            Card::getTheRankOf(array_keys($listOfCards["ranks"])[0]) - Card::getTheRankOf(array_keys($listOfCards["ranks"])[4]) == 4
        ) {
            return [
                "score" => 500,
                "type" => 50,
                "descr" => "Straight",
            ];
        } elseif (
            $listOfCards["ranks"][array_keys($listOfCards["ranks"])[0]] == 3 &&
            $listOfCards["ranks"][array_keys($listOfCards["ranks"])[1]] == 1
        ) {
            return [
                "score" => 400,
                "type" => 40,
                "descr" => "Three of a Kind",
            ];
        } elseif (
            $listOfCards["ranks"][array_keys($listOfCards["ranks"])[0]] == 2 &&
            $listOfCards["ranks"][array_keys($listOfCards["ranks"])[1]] == 2
        ) {
            return [
                "score" => 300,
                "type" => 30,
                "descr" => "Two pair",
            ];
        } elseif (
            $listOfCards["ranks"][array_keys($listOfCards["ranks"])[0]] == 2 &&
            $listOfCards["ranks"][array_keys($listOfCards["ranks"])[1]] == 1
        ) {
            return [
                "score" => 200,
                "type" => 20,
                "descr" => "One pair",
            ];
        } else {
            return [
                "score" => Card::getTheRankOf(array_keys($listOfCards["ranks"])[0]),
                "type" => 10,
                "descr" => "High Card",
            ];
        }
    }

    /**
     * Final results. We're running some summary queries to populate the final view.
     * 
     * @return Illuminate\View\View|Illuminate\Contracts\View\Factory 
     */
    public function index() {
        $stats = [
            "player_A" => [
                "wins" => \App\PokerGame::where('winner', '=', 1)->get()->count(),
                "royal_flush" => \App\PokerGame::where('winner', '=', 1)->where('winning_type', '=', 100)->get()->count(),
                "straight_flush" => \App\PokerGame::where('winner', '=', 1)->where('winning_type', '=', 90)->get()->count(),
                "four_of_a_kind" => \App\PokerGame::where('winner', '=', 1)->where('winning_type', '=', 80)->get()->count(),
                "full_house" => \App\PokerGame::where('winner', '=', 1)->where('winning_type', '=', 70)->get()->count(),
                "flush" => \App\PokerGame::where('winner', '=', 1)->where('winning_type', '=', 60)->get()->count(),
                "straight" => \App\PokerGame::where('winner', '=', 1)->where('winning_type', '=', 50)->get()->count(),
                "three_of_a_kind" => \App\PokerGame::where('winner', '=', 1)->where('winning_type', '=', 40)->get()->count(),
                "two_pair" => \App\PokerGame::where('winner', '=', 1)->where('winning_type', '=', 30)->get()->count(),
                "one_pair" => \App\PokerGame::where('winner', '=', 1)->where('winning_type', '=', 20)->get()->count(),
                "high_card" => \App\PokerGame::where('winner', '=', 1)->where('winning_type', '<', 20)->get()->count(),
            ],
            "player_B" => [
                "wins" => \App\PokerGame::where('winner', '=', 2)->get()->count(),
                "royal_flush" => \App\PokerGame::where('winner', '=', 2)->where('winning_type', '=', 100)->get()->count(),
                "straight_flush" => \App\PokerGame::where('winner', '=', 2)->where('winning_type', '=', 90)->get()->count(),
                "four_of_a_kind" => \App\PokerGame::where('winner', '=', 2)->where('winning_type', '=', 80)->get()->count(),
                "full_house" => \App\PokerGame::where('winner', '=', 2)->where('winning_type', '=', 70)->get()->count(),
                "flush" => \App\PokerGame::where('winner', '=', 2)->where('winning_type', '=', 60)->get()->count(),
                "straight" => \App\PokerGame::where('winner', '=', 2)->where('winning_type', '=', 50)->get()->count(),
                "three_of_a_kind" => \App\PokerGame::where('winner', '=', 2)->where('winning_type', '=', 40)->get()->count(),
                "two_pair" => \App\PokerGame::where('winner', '=', 2)->where('winning_type', '=', 30)->get()->count(),
                "one_pair" => \App\PokerGame::where('winner', '=', 2)->where('winning_type', '=', 20)->get()->count(),
                "high_card" => \App\PokerGame::where('winner', '=', 2)->where('winning_type', '<', 20)->get()->count(),
            ]
        ];

        return view('results', ["stats" => $stats]);
    }
}
