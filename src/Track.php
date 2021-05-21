<?php

class Track
{

	private $TOTAL_ELEMENTS = 2000;

	private $track_array;

    public function __construct()
    {
    	$this->track_array = generateTrack($TOTAL_ELEMENTS);
    }

    private function generateTrack(int $total_elements): array
    {
    	$element_type = 'S';
    	$track_array; = array()

    	for($i = 1; $i <= $this->TOTAL_ELEMENTS; $i++)
    	{
    		if($i % 40 === 0) // after 40 elements change element type randomly
    		{
    			if(rand(0,1) == 0)
    			{
    				$element_type = 'S';
    			}
    			else{
    				$element_type = 'C';
    			}
    		}
    		array_push($track_array, $element_type)
    	}
    	return $track_array
    }

    public function getTrack(): array
    {
    	return $this->track_array;
    }

    
}