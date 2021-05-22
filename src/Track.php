<?php

class Track
{

	private $track_array;

	private $element_block = 40

	private $STRAIGHT = 0;
	private $CURVE = 1;

    public function __construct(int $total_elements)
    {
    	
    	$this->track_array = $this->generateTrack($total_elements);
    }

    private function generateTrack(int $total_elements): array
    {
    	$element_type = $this->STRAIGHT;
    	$track_array = array();

    	for($i = 1; $i <= $total_elements; $i++)
    	{
    		if($i % $this->element_block == 0) // after 40 elements change element type randomly
    		{
    			if(rand(0,1) == 0)
    			{
    				$element_type = $this->STRAIGHT;
    			}
    			else{
    				$element_type = $this->CURVE;
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