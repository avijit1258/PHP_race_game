<?php

class Car
{

	private $id;
    private $speedOnCurve;
    private $speedOnStraight;
    private static $MINIMUM_SPEED = 4;
    private static $TOTAL_SPEED = 22;


    public function __construct(int $id)
    {
    	$this->id = $id;
        $this->speedOnCurve = rand(self::$MINIMUM_SPEED, self::$TOTAL_SPEED - self::$MINIMUM_SPEED);
        $this->speedOnStraight = self::$TOTAL_SPEED - $this->speedOnCurve;

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
