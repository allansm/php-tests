<?php

include("../functions/util.php");

$filters = explode(";",$argv[1]);

$lines = file("data/.log");


foreach($lines as $line){
	$flag = true;
	foreach($filters as $filter){
		if(!has($line,$filter)){
			$flag = false;	
		}
	}
	if($flag){
		print("$line");
	}
}
