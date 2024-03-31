<?
class Player{
    
    private $name;
    private $gender;
    private $handicap;
    private $force;
    private $velocity;
    private $reaction;
    public $luck;
    public $win_chance;

    const FORCE_STRING = "force";
    const VELOCITY_STRING = "velocity";
    const REACTION_STRING = "reaction";

    const MAX_HANDICAP = 100;
    const MAX_FORCE = 10;
    const MAX_VELOCITY = 10;
    const MAX_REACTION = 10;
    const MAX_LUCK = 10;
    const LUCK_BOOST_PERCENTAGE = 5;


    public __construct($name, $gender, $handicap, $extra){
        $this->name = $name;
        $this->gender = $gender;
        $this->handicap = min($handicap, self::MAX_HANDICAP);
        if($gender == "M"){
            if(!isset($extra[self::FORCE_STRING]) || !isset($extra[self::VELOCITY_STRING])){
                throw new Exception("Missing Male Stats", 999);
            }
            $this->force = min($extra[self::FORCE_STRING], self::MAX_FORCE);
            $this->velocity = min($extra[self::VELOCITY_STRING], self::MAX_VELOCITY);
            $this->reaction = 0;
        } else if ($gender == "F"){
            if(!isset($extra[self::REACTION_STRING])){
                throw new Exception("Missing Female Stats", 999);
            }
            $this->velocity = 0;
            $this->force = 0;
            $this->reaction = min($extra[self::REACTION_STRING], self::MAX_REACTION);
        } else {
            throw new Exception("No gender specified", 999);
        }
    }

    public function calculateRoundWinChance(){
        $this->luck = rand()&self::MAX_LUCK;
        $max_value = self::MAX_HANDICAP;
        if($this->gender == "M"){
            $max_value += self::MAX_FORCE + self::MAX_VELOCITY;
        } else {
            $max_value += self::MAX_REACTION;
        }
        $aux_chance = $this->force + $this->velocity + $this->reaction + $this->handicap;
        $aux_chance *= 100;
        $this->win_chance = number_format($aux_chance / $max_value, 2);
    }

    public function luckiest(){
        $this->win_chance *= (1 + self::LUCK_BOOST_PERCENTAGE/100);
    }
}