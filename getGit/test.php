<?php

include("import/ttodua.php");
include("../functions/util.php");
include("../functions/fileHandle.php");

//$user = $argv[1];
function getContribution($user){
	$data = get_remote_data("https://github.com/users/$user/contributions");

	$lines = getLines($data);
	$higher = 0;
	$hdate = "";

	$persist = "";
	
	$contributions = array();
	$i = 0;
	foreach($lines as $line){
		if(has($line,"data-date") && has($line,"data-count")){
			$contribution = find($line,"data-count=\"","\"");
			$date = find($line,"data-date=\"","\"");
			
			/*if($contribuition > $higher){
				$hdate = $date;
				$higher = $contribuition;
			}

			if(array_key_exists(2,$argv)){
				if($argv[2] == $date){
					print("$date:$contribuition\n");
					$persist.= "$date:$contribuition\n";
				}
			}else{*/
				//print("$date:$contribuition\n");
				
			//	$persist.= "$date:$contribuition\n";	
				//}
			$contributions[$i]["date"] = $date;
			$contributions[$i++]["contribution"] = $contribution;
		}
	}
	return $contributions;
	
	/*
	if(array_key_exists(2,$argv)){
		if($argv[2] == "$"){
			print("higher $hdate:$higher\n");
			$persist.= "higher $hdate:$higher\n";
		}
	}

	if($persist != ""){
		tempWdir("getGit");
		file_put_contents(".log","$persist\n",FILE_APPEND);
	}*/
}

$contributions = getContribution("allansm");

$lines = array("","","","","","","");
$i = 0;
foreach($contributions as $tmp){
	if($i == 7){
		$i = 0;
	}
	//print($tmp["date"].":".$tmp["contribution"]."\n");
	$tmp["contribution"] = (strlen($tmp["contribution"]) == 1)?" ".$tmp["contribution"]:$tmp["contribution"];
	$lines[$i++] .= $tmp["contribution"]." ";
}

foreach($lines as $line){
	print("$line\n");
}
