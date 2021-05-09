<?php

include("../functions/time.php");
include("../functions/util.php");
include( "..\\functions\\fileHandle.php");

$flag = true;

$start = timeToMillis();
$elapsedBefore = 0;

$date = getdate();
if(array_key_exists(1,$argv)){
	if($argv[1] == "@"){
		$fn = "data/".$date["mday"].$date["mon"].$date["year"];
	}else if($argv[1] == "$"){
		$data = array_diff(scandir("data"),array(".",".."));
		print_r($data);
		$fn = "data/".$data[readline("select one file by index:")];
	}else if(str_starts_with($argv[1],"$")){
		$ind = str_replace("$","",$argv[1]);
		$ind = intval($ind);
		
		$data = array_diff(scandir("data"),array(".",".."));
		$fn = "data/".$data[$ind];
	}else{
		$fn = "data/".$argv[1];
	}
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
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			exec("echo ".$fn." ".$clock." %date% %time% >> "."data/.log");
		}else{	
			exec("echo ".$fn." ".$clock." >> "."data/.log");
		}
	}

	echo $fn." ".$clock."\n";

	if(array_key_exists(2,$argv)){
		$exp = explode(":",$argv[2]);
		$h = intval($exp[0]);
		$m = intval($exp[1]);
		$s = intval($exp[2]);

		if($hour > $h){
			print("time reached\n");
			exec("ffplay -nodisp -loop 0 -autoexit -loglevel 0 1.wav");	
		}else if($h == $hour && $minute > $m){
			print("time reached\n");
			exec("ffplay -nodisp -loop 0 -autoexit -loglevel 0 1.wav");
		}else if($h == $hour && $minute == $m && $sec > $s){
			print("time reached\n");
			exec("ffplay -nodisp -loop 0 -autoexit -loglevel 0 1.wav");
		}
	}

	sleep(1);
}
