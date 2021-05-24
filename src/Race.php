<?php

include('RaceResult.php');

class Race
{
	
    public function runRace(): RaceResult
    {


    	$raceResult = new RaceResult(5, 2000, 40);

        return $raceResult;
    }

    

}
