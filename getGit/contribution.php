<?php

include("import/ttodua.php");
include("../functions/util.php");

$user = $argv[1];

$data = get_remote_data("https://github.com/users/$user/contributions");

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

		if(array_key_exists(2,$argv)){
			if($argv[2] == $date){
				print("$date:$contribuition\n");
			}
		}else{
			print("$date:$contribuition\n");
		}
	}
}

if(array_key_exists(2,$argv)){
	if($argv[2] == "$"){
		print("higher $hdate:$higher\n");
	}
}
