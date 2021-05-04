<?php

include("import/ttodua.php");

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

function getstreams($html,$site,$keyword){
	$arr = find($html,"<a","</a>");
	$n = 1;
	$i = 0;
	$streams = array();
	foreach($arr as $link){
		$found = find($link[0],$keyword,"");
		
		if(array_key_exists(0,$found)){
			$room = find($link[0],"href=\"","\"")[0][0];
			$room = $site.$room;
			$streams[$i++] = $room;	
		}
	}
	return($streams);
}
function avaible($fname){
	$lines = file($fname);
	$i = 0;
	foreach($lines as $line){
		print($i.":".explode("^",$line)[0]."\n");
	}
}
function showstreams($pn){
	$line = file("data/patterns.txt")[$pn];
	$exp = explode("^",$line);
	$streams = getstreams(get_remote_data($exp[0]),$exp[1],$exp[2]);
	$i=0;
	foreach($streams as $stream){
		print($i++.":".$stream."\n");
	}
}
avaible("data/patterns.txt");
showstreams(readline("n:"));
//$site = readline("site:");
//print_r(getstreams(get_remote_data($site),$site,readline("keyword:")));
