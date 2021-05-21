<?php
include('Race.php');


// run a race and print the results
$test = new Race;
$results = $test->runRace();
print_r($results->getRoundResults());

// $testCar = new Car(0);
// print_r($testCar->getSpeedOnCurve());
// print_r($testCar->getSpeedOnStraight());
// print_r($testCar);

// $testTrack = new Track(2000);
// print_r($testTrack->getTrack());


