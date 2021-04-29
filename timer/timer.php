<?php

include("../functions/time.php");
include("../functions/util.php");


$wait = readline("time in minute:");
$start = timeToMillis();

while(true){
	clean();

	$hour = toHour(elapsed($start));
	$minute = toMinute(elapsed($start)) - (60*$hour);
	$sec = toSec(elapsed($start)) - (60*$minute);
	$clock = $hour . ":" . $minute . ":" . $sec;
	
	print("waiting:".$wait."\n");
	print("timer:".$clock."\n");

	if(floatval($wait) <= toMinute(elapsed($start))){
		print("time reached.");
		exec("ffplay -nodisp -autoexit -loglevel 0 1.wav");
	}else{
		sleep(1);
	}
}

