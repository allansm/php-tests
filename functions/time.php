<?php

function timeToMillis(){
	return round(microtime(true) * 1000);
}

function elapsed($sttime){
	return timeToMillis() - $sttime;
}
function toSec($millis){
	return intval($millis/1000);
}

function toMinute($millis){
	$sec = toSec($millis);
	return intval($sec/60);
}
function toHour($millis){
	$min = toMinute($millis);
	return intval($min/60);
}
