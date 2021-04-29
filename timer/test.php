<?php

include("../functions/time.php");
include("../functions/util.php");

$start = timeToMillis();

while(true){
	clean();

	$hour = toHour(elapsed($start));
	$minute = toMinute(elapsed($start)) - (60*$hour);
	$sec = toSec(elapsed($start)) - (60*$minute);
	$clock = $hour . ":" . $minute . ":" . $sec;
}
