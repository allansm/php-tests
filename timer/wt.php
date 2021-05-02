<?php

include("../functions/time.php");
include("../functions/util.php");
include( "..\\functions\\fileHandle.php");

$flag = true;

$start = timeToMillis();
$elapsedBefore = 0;

$date = getdate();
if(isset($argv[1])){
	$fn = "data/".$argv[1];
}else{
	$fn = "data/".$date["mday"].$date["mon"].$date["year"];
}

if(file_exists($fn)){
	$elapsedBefore = intval(file($fn)[0]);
}

while(true){
	clean();

	$hour = toHour(elapsed($start)+$elapsedBefore);
	$minute = toMinute(elapsed($start)+$elapsedBefore) - (60*$hour);
	$sec = toSec(elapsed($start)+$elapsedBefore) - ($hour*60*60+$minute*60);
	$clock = $hour . ":" . $minute . ":" . $sec;


	exec("echo ".(elapsed($start)+$elapsedBefore)." > ".$fn);
	
	if($flag){
		$flag = false;
		exec("echo ".$fn." ".$clock." >> "."data/.log");
	}

	echo $fn." ".$clock."\n";

	if(array_key_exists(2,$argv)){
		$exp = explode(":",$argv[2]);
		$h = intval($exp[0]);
		$m = intval($exp[1]);
		$s = intval($exp[2]);

		if($hour > $h){
			print("time reached\n");
			exec("ffplay -nodisp -autoexit -loglevel 0 1.wav");	
		}else if($h == $hour && $minute > $m){
			print("time reached\n");
			exec("ffplay -nodisp -autoexit -loglevel 0 1.wav");
		}else if($h == $hour && $minute == $m && $sec > $s){
			print("time reached\n");
			exec("ffplay -nodisp -autoexit -loglevel 0 1.wav");
		}
	}

	sleep(1);
}
