<?php

class Car
{
	private $id;
    private $speed_on_curve;
    private $speed_on_straight;
    private $MINIMUM_SPEED = 4;
    private $TOTAL_SPEED = 22;

    // int $id

    public function __construct(int $id)
    {
    	$this->id = $id;
        $this->speed_on_curve = rand($this->MINIMUM_SPEED, $this->TOTAL_SPEED - $this->MINIMUM_SPEED);
        $this->speed_on_straight = $this->TOTAL_SPEED - $this->speed_on_curve;
    }

    public function getSpeedOnCurve(): int
    {
    	return $this->speed_on_curve;
    }

    public function getSpeedOnStraight(): int
    {
    	return $this->speed_on_straight;
    }

}
