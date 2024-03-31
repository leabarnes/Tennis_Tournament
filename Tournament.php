<?
import('Round.php');
class Tournament{
    
    private $gender;
    private $players;
    private $winner;
    private $players_count;
    private $max_players;
    private $current_rounds = array();
    private $next_rounds = array();
    private $last_round = 0;


    public __construct($max_players, $gender){
        $this->max_players = $max_players;
        $this->gender = $gender;
    }

    public addPlayer($player){
        if($this->players_count < $this->max_players){
            $this->players[] = $player
            $this->players_count++;
            $player->setTournamentId($this->players_count);
        }
    }

    public function loteryRounds(){
        shuffle($this->players);
        $round_num = 0;
        $aux_round = new Round($round_num);
        foreach($this->players as $player){
            if(!$aux_round->addPlayer($player)){
                $round_num++;
                $this->current_rounds[] = $aux_round;
                $aux_round = new Round($round_num, $player);
            }
        }
        $this->last_round = $round_num;
    }

    public function playTournament(){
        if(count($this->current_rounds) == 1){
            // TODO: Final!
        }
        $round_num = $this->last_round + 1;
        $aux_round = new Round($round_num)
        foreach($this->current_rounds as $round){
            $winner = $round->playRound();
            if(!$aux_round->addPlayer($winner)){
                $round_num++;
                $this->next_rounds[] = $aux_round;
                $aux_round = new Round($round_num, $winner);
            }
        }
        $this->last_round = $round_num;
    }
}