<?php

include("../functions/util.php");
include("../functions/fileHandle.php");

function getContribution($user){
	$data = @file_get_contents("https://github.com/users/$user/contributions");

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
function getLast($contributions){
	$last = array("","","","","","","");

	foreach($contributions as $tmp){
		$last[0] = $last[1]; 
		$last[1] = $last[2]; 
		$last[2] = $last[3]; 
		$last[3] = $last[4]; 
		$last[4] = $last[5]; 
		$last[5] = $last[6];
		$last[6] = $tmp["date"].":".$tmp["contribution"];
	}

	return $last;
}
function average($contribution){
	$n = 0;
	$sum = 0;
	foreach($contribution as $tmp){
		$sum += $tmp["contribution"];
		$n++;
	}
	return $sum/$n;
}
function avarageLevel($contribution){
	$n = 0;
	$sum = 0;
	foreach($contribution as $tmp){
		$sum += $tmp["level"];
		$n++;
	}
	return $sum/$n;

}
function averageYear($contribution){
	$n = 0;
	$sum = 0;
	foreach($contribution as $tmp){
		if(has($tmp["date"],date("Y"))){

			$sum += $tmp["contribution"];
			$n++;
		}
	}
	return $sum/$n;
}
function avarageLevelYear($contribution){
	$n = 0;
	$sum = 0;
	foreach($contribution as $tmp){
		if(has($tmp["date"],date("Y"))){

			$sum += $tmp["level"];
			$n++;
		}
	}
	return $sum/$n;

}
function highest($contribution){
	$highest = 0;
	foreach($contribution as $tmp){
		if($highest < $tmp["contribution"]){
			$highest = $tmp["contribution"];	
		}
	}
	return $highest;
}
function totalContribution($contribution){
	$sum = 0;
	foreach($contribution as $tmp){
		$sum += $tmp["contribution"];
	}
	return $sum;

}
function totalYearContribution($contribution){
	$sum = 0;
	foreach($contribution as $tmp){
		if(has($tmp["date"],date("Y"))){
			$sum += $tmp["contribution"];
		}
	}
	return $sum;
}

function graph($contributions){	
	$lines = array("","","","","","","");
	$i = 0;
	
	print("\n");
	foreach($contributions as $tmp){
		if($i == 7){
			$i = 0;
		}
				
		$level = $tmp["level"];

	
		$lines[$i++] .= $level." ";
		
	}
	
	$graph = "";
	foreach($lines as $line){
		$graph .= "$line\n";
	}
		
	return $graph;
}
function graphVertical($contributions){
	$graph = "";
	foreach($contributions as $tmp){
		$graph.=$tmp["level"]." ";
		
		if($tmp["line"] == 6){
			$graph.="\n";
		}
	}
	return $graph;

}
function yearGraph($contributions){
	$year = date("Y");
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
function yearGraphVertical($contributions){
	$year = date("Y");
	$graph = "";
	$first = true;
	foreach($contributions as $tmp){
		if(has($tmp["date"],$year)){
			if($first){
				for($i = 0;$i<$tmp["line"];$i++){
					$graph .= "  ";
				}
				$first = false;
			}
			$graph.=$tmp["level"]." ";

			if($tmp["line"] == 6){
				$graph.="\n";
			}
		}
	}
	return $graph;
}

function yearGraphContribution($contributions){
	$year = date("Y");
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

function yearGraphContributionVertical($contributions){
	$year = date("Y");
	$graph = "";
	$first = true;
	foreach($contributions as $tmp){
		if(has($tmp["date"],$year)){
			if($first){
				for($i = 0;$i<$tmp["line"];$i++){
					$graph .= "   ";
				}
				$first = false;
			}
			if(strlen($tmp["contribution"]) == 1){
				$tmp["contribution"] = " ".$tmp["contribution"];
			}

			$graph.=$tmp["contribution"]." ";
			
			if($tmp["line"] == 6){
				$graph.="\n";
			}
		}
	}
	return $graph;
}

