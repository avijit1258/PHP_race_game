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

    private $cars = array();

    private $track;

    public function __construct()
    {

    	$this->createCars(5);
    	$this->createTrack(2000);
    	$this->run_race_rounds();

    }

    private function run_race_rounds()
    {
    	$step = 0;
    	$raceFinished = false;
    	while(!$raceFinished)
    	{	

    		$carsPosition = array();
    		for($i = 0; $this->cars[$i]; $i++)
    		{
    			$current_speed;
    			if($this->track->getTrack()[0] == 'S')
    			{
    				$current_speed = $this->cars[$i]->getSpeedOnStraight();
    			}else{
    				$current_speed = $this->cars[$i]->getSpeedOnCurve();
    			}

    			if($step == 0)
    			{
    				array_push($carsPosition, $current_speed);
    			}else{
    				$previous_position = $this->roundResults[$step - 1]->carsPosition[$i];
    				$next_position = $previous_position + $current_speed;

    				if($next_position >= 2000)
    				{
    					$raceFinished = true;
    				}

    				if($this->track->getTrack()[$previous_position] != $this->track->getTrack()[$next_position])
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
    	$this->track = new Track($total_elements);
		
    }
}
