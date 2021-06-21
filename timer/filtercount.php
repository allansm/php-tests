<?php

include("../functions/util.php");

$filters = explode(";",$argv[1]);

$lines = file("data/.log");

$i = 0;
foreach($lines as $line){
	$flag = true;
	foreach($filters as $filter){
		if(!has($line,$filter)){
			$flag = false;	
		}
	}
	if($flag){
		$i++;
	}
}

print($i);
