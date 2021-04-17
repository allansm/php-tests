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
