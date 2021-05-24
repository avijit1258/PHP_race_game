<?php

class Car
{

	private $id;
    private $speedOnCurve;
    private $speedOnStraight;
    private $MINIMUM_SPEED = 4;
    private $TOTAL_SPEED = 22;


    public function __construct(int $id)
    {
    	$this->id = $id;
        $this->speedOnCurve = rand($this->MINIMUM_SPEED, $this->TOTAL_SPEED - $this->MINIMUM_SPEED);
        $this->speedOnStraight = $this->TOTAL_SPEED - $this->speedOnCurve;

    }

    public function getSpeedOnCurve(): int
    {
    	return $this->speedOnCurve;
    }

    public function getSpeedOnStraight(): int
    {
    	return $this->speedOnStraight;
    }

}
