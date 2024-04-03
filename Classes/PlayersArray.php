<?php
class PlayersArray extends Player{
    
    private $players_array = array();
    private Player $first_player;
    private string $tournament_gender;
    private int $players_count = 0;
    private $alerts = array();



    function __construct($player_list){
        if(!is_array($player_list)){
            throw new Exception("Bad Array Format", 999);
        }
        $first = true;
        foreach($player_list as $player_data){
            $name = $player_data["name"];
            if(!$gender){
                $gender = $player_data["gender"];
            } else if($player_data["gender"] != $gender){
                $this->alerts[] = "Player ".$name." doesn't have same gender";
                continue;
            }
            $handicap = $player_data["handicap"];
            $extra = $player_data["extra"];
            $player = new parent($name, $gender, $handicap, $extra);
            if($first){
                $this->first_player = $player;
                $this->tournament_gender = $gender;
            }
            $this->players_count++;
            $this->players_array[] = $player;
        }
    }

    public function getFirstPlayer(){
        return $this->first_player;
    }

    public function getPlayersArray(){
        return $this->players_array;
    }

    public function getTournamentGender(){
        return $this->tournament_gender;
    }

    public function getNumPlayers(){
        return $this->players_count;
    }

    public function getAlerts(){
        return $this->alerts;
    }
}