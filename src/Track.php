<?php

class Track
{

	private $trackArray;

	private $elementPerBlock;

	public static $STRAIGHT = 0;
	public static $CURVE = 1;

    public function __construct(int $totalElements, int $elementPerBlock)
    {
    	
    	$this->elementPerBlock = $elementPerBlock;
    	$this->trackArray = $this->generateTrack($totalElements);
    }

    private function generateTrack(int $totalElements): array
    {
    	$elementType = self::$STRAIGHT;
    	$trackArray = array();

    	for($i = 1; $i <= $totalElements; $i++)
    	{
    		if($i % $this->elementPerBlock == 0) // after 40 elements change element type randomly
    		{
    			if(rand(0,1) == 0)
    			{
    				$elementType = self::$STRAIGHT;
    			}
    			else{
    				$elementType = self::$CURVE;
    			}
    		}
    		array_push($trackArray, $element_type);
    	}
    	return $trackArray;
    }

    public function getTrack(): array
    {
    	return $this->trackArray;
    }

    
}