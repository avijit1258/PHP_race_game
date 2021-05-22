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

    private $NUM_OF_CARS = 5;
    private $TOTAL_ELEMENTS = 2000;


    public function __construct()
    {

    	$this->createCars(5);
    	$this->createTrack(2000);
    	$this->runRaceRounds();

    }

    private function runRaceRounds()
    {
    	$step = 0;
    	$raceFinished = false;
    	while(!$raceFinished)
    	{	

    		$carsPosition = array();
    		for($i = 0; $this->cars[$i]; $i++)
    		{
    			$current_speed = ($this->track->getTrack()[0] == 'S') ? $this->cars[$i]->getSpeedOnStraight(): $this->cars[$i]->getSpeedOnCurve();
    			

    			if($step == 0)
    			{
    				array_push($carsPosition, $current_speed);
    			}else{
    				$previous_position = $this->roundResults[$step - 1]->carsPosition[$i];
    				$next_position = $previous_position + $current_speed;

    				if($next_position >= $this->TOTAL_ELEMENTS)
    				{
    					$raceFinished = true;
    				}

    				if($this->track[$previous_position] != $this->track[$next_position])
    				{
    					$next_position = $this->getStartPositionNextType($previous_position, $next_position);
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

    private function getStartPositionNextType(int $prev_position, int $next_position)
    {
    	$startPosition;

    	for($i = $prev_position + 1; $i <= $next_position; $i++)
    	{
    		if($this->track->getTrack()[$i - 1] != $this->track->getTrack()[$i])
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
    	$this->track = $track->getTrack()
		
    }
}
