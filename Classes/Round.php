<?php
class Round{
    
    const ROUND_TABLE = 'rounds';
    private $player1;
    private $player2;
    private $winner;
    private $num_round;
    private $tournament_id;


    function __construct($tournament_id, $num_round, $player1 = null, $player2 = null){
        $this->num_round = $num_round;
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->tournament_id = $tournament_id;
    }

    public function addPlayer($player){
        if($this->player2 != null){
            return false;
        }
        if($player == null){
            return false;
        }
        if($this->player1 != null){
            $this->player2 = $player;
        } else {
            $this->player1 = $player;
        }
        return true;
    }

    public function playRound(){
        $player1 = $this->player1;
        $player2 = $this->player2;
        if(!$player2){
            $this->winner = $player1;
            return $player1;
        }
        $player1->calculateRoundWinChance();
        $player2->calculateRoundWinChance();
        if($player1->win_chance == $player2->win_chance){
            $this->winner = $player1->luck > $player2->luck ? $player1:$player2;
        } else {
            if($player1->luck > $player2->luck){
                $player1->luckiest();
            } else if($player1->luck < $player2->luck){
                $player2->luckiest();
            }
            $this->winner = $player1->win_chance > $player2->win_chance ? $player1:$player2;
        }
        $this->saveRound();
        return $this->winner;
    }

    private function saveRound(){
        $num_round = $this->num_round;
        $player1_json = $this->player1->getJson();
        $player2_json = $this->player2 ? $this->player2->getJson():null;
        $winner = $this->winner == $this->player1 ? 1:2;
        $tournament_id = $this->tournament_id;
        $values = array("id" => $num_round, "tournament_id" => $tournament_id, "player1_json" => $player1_json, "player2_json" => $player2_json, "winner" => $winner);
        Database::insert(self::ROUND_TABLE, $values);
    }
}