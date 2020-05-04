<?php

class Tournament
{
    //Eigenschaften
    public $date;
    public $winner;
    public $second;
    public $third;
    public $buyIn;
    public $moneyFirst;
    public $moneySecond;
    public $moneyThird;


    function __construct($tournament = null)
    {
        if (!$tournament) {
            return;
        }
        
        $this->date = $tournament->date;
        $this->winner = $tournament->winner;
        $this->second = $tournament->second;
        $this->third = $tournament->third;
        $this->buyIn = $tournament->buyIn;
        $this->moneyFirst = $tournament->moneyFirst;
        $this->moneySecond = $tournament->moneySecond;
        $this->moneyThird = $tournament->moneyThird;
    }

    function getParticipants()
    {
        return [
            $this->winner,
            $this->second,
            $this->third,
        ];
    }
}

?>
