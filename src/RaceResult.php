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

    private $numOfCars;
    private $totalElements;


    public function __construct(int $numOfCars, int $totalElements, int $elementPerBlock)
    {

    	$this->numOfCars = $numOfCars;
    	$this->totalElements = $totalElements;
    	$this->createCars($numOfCars);
    	$this->createTrack($totalElements, $elementPerBlock);
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
    				$currentSpeed = ($this->track[0] == Track::$STRAIGHT) ? $this->cars[$i]->getSpeedOnStraight(): $this->cars[$i]->getSpeedOnCurve();
    				array_push($carsPosition, $currentSpeed);
    			}else{
    				
    				$previousPosition = $this->roundResults[$step - 1]->carsPosition[$i];
    				$currentSpeed = ($this->track[$previousPosition] == Track::$STRAIGHT) ? $this->cars[$i]->getSpeedOnStraight(): $this->cars[$i]->getSpeedOnCurve();
    				$nextPosition = $previousPosition + $currentSpeed;

    				// when next position goes to a different track type
    				if($this->track[$previousPosition] != $this->track[$nextPosition])
    				{
    
    					$nextPosition = $this->getStartPositionNextType($previousPosition, $nextPosition);
    				}

    				if($nextPosition >= $this->totalElements - 1)
    				{
    					$raceFinished = true;
    				}

    				array_push($carsPosition, $nextPosition);
    			}


    		}
    		$roundResult = new RoundResult($step, $carsPosition);
    		array_push($this->roundResults, $roundResult);
    		$step += 1;
    	}
    }

    public function getRoundResults(): array
    {
        return $this->roundResults;
    }

    private function getStartPositionNextType(int $prevPosition, int $nextPosition) : int
    {
    	

    	for($i = $prevPosition + 1; $i <= $nextPosition; $i++)
    	{
    		if($this->track[$i - 1] != $this->track[$i])
    		{
    			return $i;
    		}
    	} 
    }
    private function createCars(int $numOfCars)
    {
    	for($i = 0; $i < $numOfCars; $i++)
    	{
    		$newCar = new Car($i);
    		array_push($this->cars, $newCar);
    	}
    
    }

    private function createTrack(int $totalElements, int $elementPerBlock)
    {
    	$track = new Track($totalElements, $elementPerBlock);
    	$this->track = $track->getTrack();
		
    }
}
