<?
class Round{
    
    private $player1;
    private $player2;
    private $winner;
    private $num_round;


    function __construct($num_round, $player1 = null, $player2 = null){
        $this->num_round = $num_round;
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    public function addPlayer($player){
        if($this->player2 != null){
            return false;
        }
        if($player == null){
            return false;
        }
        if(isset($this->player1)){
            $this->player2 = $player;
        } else {
            $this->player1 = $player;
        }
        return false;
    }

    public function playRound(){
        $player1 = $this->player1;
        $player2 = $this->player2;
        $player1->calculateRoundWinChance();
        $player2->calculateRoundWinChance();
        if($player1->win_chance == $player2->win_chance){
            $winner = $player1->luck > $player2->luck ? $player1->tournament_id:$player2->tournament_id;
        } else {
            if($player1->luck > $player2->luck){
                $player1->luckiest();
            } else if($player1->luck < $player2->luck){
                $player2->luckiest();
            }
            $this->winner = $player1->win_chance > $player2->win_chance ? $player1:$player2;
        }
        return $this->winner;
    }
}