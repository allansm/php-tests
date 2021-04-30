<?php
include("../functions/time.php");

$SECOND = 1000;
$MINUTE = $SECOND*60;
$HOUR = $MINUTE*60;

function add($fname,$ms){	
	$new = $ms+intval(file($fname)[0]);
	exec("echo ".$new." > ".$fname);
}

function subtract($fname,$ms){
	$new = intval(file($fname)[0])-$ms;
	exec("echo ".$new." > ".$fname);
	
}

function show($fname){
	$elapsed = intval(file($fname)[0]);
	$ho = toHour($elapsed);
	$min = toMinute($elapsed) - (60*$ho);
	$sec = toSec($elapsed)-($ho*60*60+$min*60);
	$clock = $ho . ":" . $min . ":" . $sec;
	print($clock."\n");	
}
function console($argv){
	global $SECOND,$MINUTE,$HOUR;

	$fname = "data/".$argv[1];
	
	$op = readline("1: show elapsed 2: add time 3:subtract time :");
	if($op == 1){
		show($fname);
	}else if($op == 2){
		$h = readline("hour:");
		$m = readline("minute:");
		$s = readline("second:");
		
		$ms = (intval($h)*$HOUR)+(intval($m)*$MINUTE)+(intval($s)*$SECOND);
		
		add($fname,$ms);
	}else if($op == 3){
		$h = readline("hour:");
		$m = readline("minute:");
		$s = readline("second:");
		
		$ms = (intval($h)*$HOUR)+(intval($m)*$MINUTE)+(intval($s)*$SECOND);
		
		subtract($fname,$ms);
	}
}

while(true)
	console($argv);
