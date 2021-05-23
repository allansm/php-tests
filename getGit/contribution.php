<?php

include("import/ttodua.php");
include("../functions/util.php");

$data = get_remote_data("https://github.com/users/allansm/contributions");

$lines = getLines($data);
$higher = 0;
$hdate = "";
foreach($lines as $line){
	if(has($line,"data-date") && has($line,"data-count")){
		$contribuition = find($line,"data-count=\"","\"");
		$date = find($line,"data-date=\"","\"");
		
		if($contribuition > $higher){
			$hdate = $date;
			$higher = $contribuition;
		}

		if(array_key_exists(1,$argv)){
			if($argv[1] == $date){
				print("$date:$contribuition\n");
			}
		}else{
			print("$date:$contribuition\n");
		}
	}
}

if(array_key_exists(1,$argv)){
	if($argv[1] == "$"){
		print("higher $hdate:$higher\n");
	}
}
