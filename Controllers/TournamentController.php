<?php
include BASE_DIR.'/Classes/Player.php';
include BASE_DIR.'/Classes/PlayersArray.php';
include BASE_DIR.'/Classes/Round.php';
include BASE_DIR.'/Classes/Tournament.php';
include BASE_DIR.'/Classes/Database.php';
class TournamentController{

    private $current_tournament;
    public function __contruct(){

    }

    public function  getPostPlayersList():bool|PlayersArray{
        if(!isset($_POST['player_list'])){
            return false;
        }
        return new PlayersArray($_POST['player_list']);
    }

    public function getSequentialPlayerList($num_players, $gender){
        $player_list = array();
        for($i = 0; $i<$num_players; $i++){
            $name = "Test ".$i;
            $handicap = $i%Player::MAX_HANDICAP+1;
            $extra[Player::FORCE_STRING] = $i%Player::MAX_FORCE+1;
            $extra[Player::VELOCITY_STRING] = $i%Player::MAX_VELOCITY+1;
            $extra[Player::REACTION_STRING] = $i%Player::MAX_REACTION+1;
            $player_list[] = new Player($name, $gender, $handicap, $extra);
        }
        return $player_list;
    }
    public function getRandomPlayerList($num_players, $gender){
        $player_list = array();
        for($i = 0; $i<$num_players; $i++){
            $name = "Test ".$i;
            $handicap = rand(1,Player::MAX_HANDICAP);
            $extra[Player::FORCE_STRING] = rand(1,Player::MAX_FORCE);
            $extra[Player::VELOCITY_STRING] = rand(1,Player::MAX_VELOCITY);
            $extra[Player::REACTION_STRING] = rand(1,Player::MAX_REACTION);
            $player_list[] = new Player($name, $gender, $handicap, $extra);
        }
        return $player_list;
    }

    public function startTournament($num_players = null, $gender = null, $random = false){
        if(!$num_players){
            $players_array = $this->getPostPlayersList();
            if(!$players_array){
                throw new Exception("An error ocurred when trying to get the players list", 999);
            }
            $player_list = $players_array->getPlayersArray();
            $num_players = $players_array->getNumPlayers();
            $gender = $players_array->getTournamentGender();
        } else {
            $gender = $gender ?? rand(0,1) ? "M":"F";
            if($random){
                $player_list = $this->getRandomPlayerList($num_players, $gender);
            } else {
                $player_list = $this->getSequentialPlayerList($num_players, $gender);
            }
        }
        $this->current_tournament = $tournament = new Tournament($num_players, $gender);
        $tournament_id = $tournament->getLastTournamentId() + 1;
        $tournament->setCurrentId($tournament_id);
        $tournament->save();
        foreach($player_list as $player){
            $tournament->addPlayer($player);
        }
        $tournament->lotteryRounds();
        $max_phases = $tournament->calculatePhases();
        $current_phase = 0;
        do{
            $winner = $tournament->playPhase();
            $current_phase++;
        } while (!$winner && $current_phase<=$max_phases);
        if(!$winner){
            return false;
        }
        return $winner;
    }

    public static function createNewRound($tournament_id, $round_num, $player = null){
        return new Round($tournament_id, $round_num, $player);
    }

}

$TOURNAMENT_CONTROLLER = new TournamentController();