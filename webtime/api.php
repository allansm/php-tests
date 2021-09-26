<?php

function getApi(){
	return "http://worldtimeapi.org/api/timezone/";	
}

function getApiTime($location){
	return json_decode(file_get_contents(getApi().$location));
}

function getTime($location){
	$apitime = getApiTime($location);
	
	$weeDay = array("sun","mon","tue","wed","thu","fri","sat");
		
	$time = [];

	$time["date"] = explode("T",$apitime->datetime)[0];
	$time["ms"] = $apitime->unixtime;
	$time["current"] = explode(".",explode("T",$apitime->datetime)[1])[0];
	$time["day"] = $weeDay[$apitime->day_of_week];

	return $time;
}

