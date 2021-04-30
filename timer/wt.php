<?php

include("../functions/time.php");
include("../functions/util.php");
include( "..\\functions\\fileHandle.php");


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
	$sec = toSec(elapsed($start)+$elapsedBefore) - ($hour*60*60+$minute*60);#(60*$minute);
	$clock = $hour . ":" . $minute . ":" . $sec;

	exec("echo ".(elapsed($start)+$elapsedBefore)." > ".$fn);

	echo $fn." ".$clock;
	sleep(1);
}
