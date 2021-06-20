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

function pause($ret){
	if(file_exists("data/pause")){
		clean();
		echo "stopped.";
		pause(true);	
	}else{
		return $ret;
	}

}


persist("waiting to $title waittime:$wait");

$start = timeToMillis();

$once = true;

$elapsed = elapsed($start);

while(true){
	clean();	
	$hour = toHour($elapsed);
	$minute = toMinute($elapsed) - (60*$hour);
	$sec = toSec($elapsed) - ($hour*60*60+$minute*60);
	$clock = $hour . ":" . $minute . ":" . $sec;

	print("waiting to ".$title."\n");
	print("waiting:".$wait."\n");
	print("timer:".$clock."\n");

	if(floatval($wait) <= toMinute($elapsed)){
		print("time reached.");

		if($once){
			$once = false;
			persist("time to $title reached");
			toast("time to $title","Timer","bin/notifu");
		}
		
		exec("ffplay -nodisp -loop 0 -autoexit -loglevel 0 1.wav");
		die();
	}else{
		sleep(1);
	}

	$paused = elapsed($start);
	if(pause(false)){
		$start = timeToMillis() + $paused;
	}
}

