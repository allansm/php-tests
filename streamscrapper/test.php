<?php

include("import/ttodua.php");
include("../functions/util.php");

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
		print($i++.":".explode("^",$line)[0]."\n");
	}
}
function showstreams($pn){
	$line = file("data/patterns.txt")[$pn];
	$exp = explode("^",$line);
	$streams = getstreams(get_remote_data(removeLineBreak($exp[0])),removeLineBreak($exp[1]),removeLineBreak($exp[2]));
	$i=0;
	foreach($streams as $stream){
		print($i++.":".$stream."\n");
	}
}
function play($n,$pn){
	$line = file("data/patterns.txt")[$pn];
	$exp = explode("^",$line);
	$streams = getstreams(get_remote_data(removeLineBreak($exp[0])),removeLineBreak($exp[1]),removeLineBreak($exp[2]));
	$i=0;
	foreach($streams as $stream){
		$room = $stream;
		if($n == $i++){
			while(true){
				exec("youtube-dl -f \"bestvideo[height<=720]+bestaudio/best[height<=720]\" --get-url ".$room." > data/room");
				$url = file("data/room")[0];
				print("watching:".$room."\n");
				exec("echo ".$room." > data/.log");
				if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
					exec("ffplay -an -x 300 -y 170 -top 28 -left 1000 -noborder -alwaysontop -framedrop -autoexit -fflags nobuffer -loglevel 0 ".$url);
				}else{
					exec("ffplay -an -x 300 -y 170  -framedrop -autoexit -fflags nobuffer -loglevel 0 ".$url);
				}
			}	
		}
	}

}
avaible("data/patterns.txt");
$pn = readline("n:");
showstreams($pn);
play(readline("n:"),$pn);
