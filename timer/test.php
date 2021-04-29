<?php

include("../functions/time.php");
include("../functions/util.php");
include( "..\\functions\\fileHandle.php");

if(!file_exists("test.txt")){
	$start = timeToMillis();
	sleep(1);
	exec("echo ".elapsed($start)." > test.txt");	

}else{
	if(strtolower(readline("continue ?(y/n):")) == "n"){
		$start = timeToMillis();
		sleep(1);
		exec("echo ".elapsed($start)." > test.txt");
	}else{
		$start = intval(removeLineBreak(trim(file("test.txt")[0])));
	}
}

while(true){
	clean();

	$hour = toHour(elapsed($start));
	$minute = toMinute(elapsed($start)) - (60*$hour);
	$sec = toSec(elapsed($start)) - (60*$minute);
	$clock = $hour . ":" . $minute . ":" . $sec;
	
	echo $clock;
	sleep(1);
}
