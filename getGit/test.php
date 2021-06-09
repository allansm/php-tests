<?php

include("import/ttodua.php");
include("../functions/util.php");
include("../functions/fileHandle.php");

function getContribution($user){
	$data = get_remote_data("https://github.com/users/$user/contributions");

	$lines = getLines($data);
	$higher = 0;
	$hdate = "";

	$persist = "";
	
	$contributions = array();
	$i = 0;
	$gl = 0;
	foreach($lines as $line){
		if(has($line,"data-date") && has($line,"data-count")){
			if($gl == 7){
				$gl = 0;
			}

			$contribution = find($line,"data-count=\"","\"");
			$date = find($line,"data-date=\"","\"");
			$level = find($line,"data-level=\"","\"");

			$contributions[$i]["date"] = $date;
			$contributions[$i]["level"] = $level;
			$contributions[$i]["line"] = $gl++;
			$contributions[$i++]["contribution"] = $contribution;
		}
	}
	return $contributions;	
}
function txtGraph($contributions){
	//$contributions = getContribution($user);

	$lines = array("","","","","","","");
	$i = 0;

	$last = "";

	print("\n");
	foreach($contributions as $tmp){
		if($i == 7){
			$i = 0;
		}
		/*
		if(strlen($tmp["contribution"]) == 1){
			$tmp["contribution"] = " ".$tmp["contribution"];
		}
		 */
		
		$level = $tmp["level"];

		/*
		$level = "";

		if($tmp["level"] == 0){
			$level = "X";
		}else if($tmp["level"] == 1){
			$level = "C";
		}else if($tmp["level"] == 2){
			$level = "B";
		}else if($tmp["level"] == 3){
			$level = "A";
		}else{
			$level = "S";
		}
		 */

		$lines[$i++] .= $level." ";
		$last = $tmp["date"].":".$tmp["contribution"];
	}
	
	$graph = "";
	foreach($lines as $line){
		$graph .= "$line\n";
	}

	//print("\nlast contribuitio  $last\n");
	
	$arr = array();
	
	$arr[0]["graph"] = $graph;
	$arr[0]["last"] = $last;

	return $arr;
}
function yearGraph($contributions,$year){
	$lines = array("","","","","","","");
	$first = true;
	
	foreach($contributions as $tmp){
		if(has($tmp["date"],$year)){
			if($first){
				for($i = 0;$i<$tmp["line"];$i++){
					$lines[$i].= "  ";
				}
				$first = false;
			}
			$lines[$tmp["line"]].=$tmp["level"]." ";
		}
	}
	foreach($lines as $line){
		print("$line\n");
	}
}
function yearGraphContribution($contributions,$year){
	$lines = array("","","","","","","");
	$first = true;
	
	foreach($contributions as $tmp){
		if(has($tmp["date"],$year)){
			if($first){
				for($i = 0;$i<$tmp["line"];$i++){
					$lines[$i].= "   ";
				}
				$first = false;
			}
			if(strlen($tmp["contribution"]) == 1){
				$tmp["contribution"] = " ".$tmp["contribution"];
			}
			$lines[$tmp["line"]].=$tmp["contribution"]." ";
		}
	}
	foreach($lines as $line){
		print("$line\n");
	}
}
$contributions = getContribution("allansm");
$graph = txtGraph($contributions)[0]["graph"];
$last = txtGraph($contributions)[0]["last"];

yearGraph($contributions,2021);
print("\n");
yearGraphContribution($contributions,2021);
//print_r($contributions);
//print("\n$graph");
//print("\n$last\n");
die();

$contributions = getContribution("allansm");

$lines = array("","","","","","","");
$i = 0;

$last = "";

print("\n");
foreach($contributions as $tmp){
	if($i == 7){
		$i = 0;
	}
	/*
	if(strlen($tmp["contribution"]) == 1){
		$tmp["contribution"] = " ".$tmp["contribution"];
	}
	*/	
	$lines[$i++] .= $tmp["level"]." ";
	$last = $tmp["date"].":".$tmp["contribution"];
}

foreach($lines as $line){
	print("$line\n");
}

print("\nlast contribuitio  $last\n");
