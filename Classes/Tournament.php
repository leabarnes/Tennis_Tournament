<?php
class Tournament{

    const TOURNAMENT_TABLE = 'tournaments';
    
    private $id;
    private $gender;
    private $winner;
    private $players_count;
    private $max_players;
    private $players = array();
    private $current_rounds = array();
    private $next_rounds = array();
    private $last_round = 0;
    private $doubles = false;


    function __construct($max_players, $gender){
        $this->max_players = $max_players;
        $this->gender = $gender;
    }

    function setCurrentId($id){
        $this->id = $id;
    }

    public function addPlayer($player){
        if($this->players_count < $this->max_players){
            $this->players[] = $player;
            $this->players_count++;
        }
    }

    public function lotteryRounds(){
        shuffle($this->players);
        $round_num = 0;
        $aux_round = TournamentController::createNewRound($this->id, $round_num);
        foreach($this->players as $player){
            if(!$aux_round->addPlayer($player)){
                $round_num++;
                $this->current_rounds[] = $aux_round;
                $aux_round = TournamentController::createNewRound($this->id, $round_num, $player);
            }
        }
        $this->last_round = $round_num;
    }

    public function playPhase(){
        if(count($this->current_rounds) == 1){
            $round = array_pop($this->current_rounds);
            return $round->playRound();
        }
        $round_num = $this->last_round + 1;
        $aux_round = TournamentController::createNewRound($this->id, $round_num);
        foreach($this->current_rounds as $round){
            $winner = $round->playRound();
            if(!$aux_round->addPlayer($winner)){
                $round_num++;
                $this->next_rounds[] = $aux_round;
                $aux_round = TournamentController::createNewRound($this->id, $round_num, $winner);
            }
        }
        $this->current_rounds = $this->next_rounds;
        $this->next_rounds = array();
        $this->last_round = $round_num;
        return false;
    }

    public function calculatePhases(){
        $phases_count = 0;
        $final_match = $this->doubles ? 4:2;
        $num_players = $this->players_count;
        while($num_players >= $final_match){
            $mod = $num_players % 2;
            $num_players = ($num_players - $mod)/2;
            $phases_count++;
        }
        return $phases_count;
    }

    public function getLastTournamentId(){
        $select = "id";
        $tables = self::TOURNAMENT_TABLE;
        $where = "TRUE ORDER BY id DESC LIMIT 1";
        $last_id = Database::find($select, $tables, $where, "single");
        return $last_id ? $last_id['id']:0;
    }

    public function saveNew(){
        $values = array("id" => $this->id, "gender" => $this->gender);
        Database::insert(self::TOURNAMENT_TABLE, $values);
    }

    public function update($values, $where){
        Database::update(self::TOURNAMENT_TABLE, $values, $where);
    }

    public function delete($id){
        $where = "id = ".$id;
        Database::delete(self::TOURNAMENT_TABLE, $where);
    }
}