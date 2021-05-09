<?php

include("../functions/time.php");
include("../functions/util.php");


$wait = readline("time in minute:");
$title = readline("waiting to ");

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
	exec("echo waiting to $title waittime:$wait time:%date% %time% >> data/.log");	
}else{
	exec("echo waiting to $title time:$wait >> data/.log");
}
$start = timeToMillis();

while(true){
	clean();

	$hour = toHour(elapsed($start));
	$minute = toMinute(elapsed($start)) - (60*$hour);
	$sec = toSec(elapsed($start)) - ($hour*60*60+$minute*60);
	$clock = $hour . ":" . $minute . ":" . $sec;

	print("waiting to ".$title."\n");
	print("waiting:".$wait."\n");
	print("timer:".$clock."\n");

	if(floatval($wait) <= toMinute(elapsed($start))){
		print("time reached.");
		exec("ffplay -nodisp -autoexit -loglevel 0 1.wav");
	}else{
		sleep(1);
	}
}

