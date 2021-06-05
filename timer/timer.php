<?php

include("../functions/time.php");
include("../functions/util.php");
include("../functions/fileHandle.php");

$wait = readline("time in minute:");
$title = readline("waiting to ");

createFolder("data");

function persist($msg){
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		exec("echo $msg time:%date% %time% >> data/.log");	
	}else{
		exec("echo $msg >> data/.log");
	}
}

/*
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
	exec("echo waiting to $title waittime:$wait time:%date% %time% >> data/.log");	
}else{
	exec("echo waiting to $title time:$wait >> data/.log");
}
 */

persist("waiting to $title waittime:$wait");

$start = timeToMillis();

$once = true;

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

		if($once){
			$once = false;
			toast("time to $title","Timer","bin/notifu");
			persist("time to $title reached");
		}
		
		exec("ffplay -nodisp -loop 0 -autoexit -loglevel 0 1.wav");
		die();
	}else{
		sleep(1);
	}
}

