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
			//$contributions[$i]["last"] = $last;
			$contributions[$i++]["contribution"] = $contribution;
		}
	}
	return $contributions;	
}
function getLast($contributions){
	$last = array("","","");

	foreach($contributions as $tmp){
		$last[0] = $last[1]; 
		$last[1] = $last[2];
		$last[2] = $tmp["date"].":".$tmp["contribution"];
	}

	return $last;
}
function graph($contributions){	
	$lines = array("","","","","","","");
	$i = 0;

	//$last = array("","","");

	print("\n");
	foreach($contributions as $tmp){
		if($i == 7){
			$i = 0;
		}
				
		$level = $tmp["level"];

	
		$lines[$i++] .= $level." ";

		/*
		$last[0] = $last[1]; 
		$last[1] = $last[2];
		$last[2] = $tmp["date"].":".$tmp["contribution"];
		 */
	}
	
	$graph = "";
	foreach($lines as $line){
		$graph .= "$line\n";
	}
	
	//$arr = array();
	
	return $graph;
	//$arr[0]["last"] = $last;

	//return $arr;
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
	$graph = "";
	foreach($lines as $line){
		$graph .= "$line\n";
	}

	return $graph;
}
function yearGraphVertical($contribution,$year){
	foreach($contributions as $tmp){
		if(has($tmp["date"],$year)){
			if($first){
				/*for($i = 0;$i<$tmp["line"];$i++){
					$lines[$i].= "  ";
			}*/
				$first = false;
			}
			//$lines[$tmp["line"]].=$tmp["level"]." ";
		}
	}

}

function yearGraphContribution($contributions,$year){
	$lines = array("","","","","","","");
	$first = true;
	
	foreach($contributions as $tmp){
		if(has($tmp["date"],$year)){
			if($tmp["contribution"] > 99){
				$tmp["contribution"] = 99;
			}

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
	$graph = "";
	foreach($lines as $line){
		$graph .= "$line\n";
	}

	return $graph;

}

