<?php
include("../functions/time.php");
include("../functions/util.php");
include( "..\\functions\\fileHandle.php");

$start = timeToMillis();
$title = readline("title:");
while(true){
	clean();

	$hour = toHour(elapsed($start));
	$minute = toMinute(elapsed($start)) - (60*$hour);
	$sec = toSec(elapsed($start)) - ($hour*60*60+$minute*60);
	$clock = $hour . ":" . $minute . ":" . $sec;

	echo($title."\n");
	echo $clock;
	sleep(1);
}
