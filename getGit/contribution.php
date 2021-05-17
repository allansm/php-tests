<?php

include("import/ttodua.php");

$data = get_remote_data("https://github.com/users/allansm/contributions");

function find($html,$p1,$p2){
	$p1 = str_replace("/", "\/", $p1);
	$p2 = str_replace("/", "\/", $p2);
	
	$linkArray = array();
	if(preg_match_all("/$p1(.*?)$p2/i", $html, $matches, PREG_SET_ORDER)){
		foreach ($matches as $match) {
			array_push($linkArray, array($match[1], @$match[2]));
		}
	}
	return $linkArray;
}


$lines = explode("\n",$data);


foreach($lines as $line){
	$found = find($line,"data-date","");
	$found2 = find($line,"data-count=\"","\"");	
	if(array_key_exists(0,$found) && array_key_exists(0,$found2)){
		$contribution = find($line,"data-count=\"","\"")[0][0];
		$date = find($line,"data-date=\"","\"")[0][0];
		print($date.":".$contribution."\n");
	}
	unset($found);	
}
