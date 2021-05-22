<?php

include('Car.php');
include('Track.php');
include('RoundResult.php');

class RaceResult
{
    /**
     * @var array of StepResult
     */
    private $roundResults = [];

    /**
     * @var array of Car
     */

    private $cars = array();

    /**
     * @var array of Track
     */

    private $track;

    private static $NUM_OF_CARS = 5;
    private static $TOTAL_ELEMENTS = 2000;


    public function __construct()
    {

    	$this->createCars(self::$NUM_OF_CARS);
    	$this->createTrack(self::$TOTAL_ELEMENTS);
    	$this->runRaceRounds();

    }

    private function runRaceRounds()
    {
    	$step = 0;
    	$raceFinished = false;
    	while(!$raceFinished)
    	{	

    		$carsPosition = array();
    		for($i = 0; $i < count($this->cars); $i++)
    		{

    			if($step == 0)
    			{
    				$current_speed = ($this->track[0] == Track::$STRAIGHT) ? $this->cars[$i]->getSpeedOnStraight(): $this->cars[$i]->getSpeedOnCurve();
    				array_push($carsPosition, $current_speed);
    			}else{
    				
    				$previous_position = $this->roundResults[$step - 1]->carsPosition[$i];
    				$current_speed = ($this->track[$previous_position] == Track::$STRAIGHT) ? $this->cars[$i]->getSpeedOnStraight(): $this->cars[$i]->getSpeedOnCurve();
    				$next_position = $previous_position + $current_speed;

    				if($this->track[$previous_position] != $this->track[$next_position])
    				{
    
    					$next_position = $this->getStartPositionNextType($previous_position, $next_position);
    				}

    				if($next_position >= self::$TOTAL_ELEMENTS)
    				{
    					$raceFinished = true;
    				}

    				array_push($carsPosition, $next_position);
    			}


    		}
    		$round_result = new RoundResult($step, $carsPosition);
    		array_push($this->roundResults, $round_result);
    		$step += 1;
    	}
    }

    public function getRoundResults(): array
    {
        return $this->roundResults;
    }

    private function getStartPositionNextType(int $prev_position, int $next_position) : int
    {
    	$startPosition;

    	for($i = $prev_position + 1; $i <= $next_position; $i++)
    	{
    		if($this->track[$i - 1] != $this->track[$i])
    		{
    			return $i;
    		}
    	} 
    }
    private function createCars(int $num_of_cars)
    {
    	for($i = 0; $i < $num_of_cars; $i++)
    	{
    		$newCar = new Car($i);
    		array_push($this->cars, $newCar);
    	}
    
    }

    private function createTrack(int $total_elements)
    {
    	$track = new Track($total_elements);
    	$this->track = $track->getTrack();
		
    }
}
