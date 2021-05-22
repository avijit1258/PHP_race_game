<?php

class Track
{

	private $track_array;

	private static $ELEMENT_BLOCK = 40;

	public static $STRAIGHT = 0;
	public static $CURVE = 1;

    public function __construct(int $total_elements)
    {
    	
    	$this->track_array = $this->generateTrack($total_elements);
    }

    private function generateTrack(int $total_elements): array
    {
    	$element_type = self::$STRAIGHT;
    	$track_array = array();

    	for($i = 1; $i <= $total_elements; $i++)
    	{
    		if($i % self::$ELEMENT_BLOCK == 0) // after 40 elements change element type randomly
    		{
    			if(rand(0,1) == 0)
    			{
    				$element_type = self::$STRAIGHT;
    			}
    			else{
    				$element_type = self::$CURVE;
    			}
    		}
    		array_push($track_array, $element_type);
    	}
    	return $track_array;
    }

    public function getTrack(): array
    {
    	return $this->track_array;
    }

    
}