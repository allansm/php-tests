<?php

include("import\\ttodua.php");
include("../functions/ff.php");
include("../functions/util.php");

function filter($txt,$pattern){
	$pattern = explode(";",$pattern);
	
	$size = sizeof($pattern);
	$i = 0;
	foreach($pattern as $p){
		if(has($txt,$p)){
			$i++;
		}
	}
	return ($i == $size)?true:false;
}

while(true){
	$start = get_remote_data($argv[1]);

	$lines = explode("\n",$start);


	$links = array();
	foreach($lines as $line){
		if(filter($line,$argv[2])){
			array_push($links,find($line,"href=\"","\""));
		}
	}

	print_r($links);

	shuffle($links);

	$second = get_remote_data($links[0]);

	$lines2 = explode("\n",$second);


	$third = "";
	foreach($lines2 as $line){
		if(filter($line,$argv[3])){
			$third = get_remote_data(find($line,"href=\"","\""));
		}
	}

	$lines3 = explode("\n",$third);

	print_r($lines3);

	$forth = "";
	foreach($lines3 as $line){
		if(filter($line,$argv[4])){
			$forth = get_remote_data(find($line,"href=\"","\""));
		}
	}
	$lines4 = explode("\n",$forth);
	foreach($lines4 as $line){
		if(filter($line,$argv[5])){
			$mp4 = find($line,"href=\"","\"");
			print($mp4);
			player("",$mp4);
		}
	}
}
