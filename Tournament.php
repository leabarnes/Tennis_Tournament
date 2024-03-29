class Tournament{
    
    private $gender;
    private $players;
    private $winner;
    private $players_count;
    private $max_players;


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

    public function playRound(Player $player1, Player $player2){
        $player1->calculateRoundWinChance();
        $player2->calculateRoundWinChance();
        if($player1->win_chance == $player2->win_chance){
            $winner = $player1->luck > $player2->luck ? $player1->tournament_id:$player2->tournament_id;
        } else {
            $winner = $player1->win_chance > $player2->win_chance ? $player1->tournament_id:$player2->tournament_id;
        }
        $this->winPlayer($winner);
    }
}