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
	$limit = (has($argv[1],"###")) ? find($argv[1],"###","###"):158;
	$arg = (has($argv[1],"???")) ? str_replace("???",rand(1,$limit),$argv[1]) : $argv[1];

	$arg = (has($arg,"###"))?str_replace("###".$limit."###","",$arg):$arg;
	
	print($arg."\n");
		
	$start = get_remote_data($arg);

	$lines = explode("\n",$start);


	$links = array();
	foreach($lines as $line){
		if(filter($line,$argv[2])){
			array_push($links,find($line,"href=\"","\""));
		}
	}

	shuffle($links);
	
	print($links[0]."\n");
	
	$second = get_remote_data($links[0]);

	$lines2 = explode("\n",$second);


	$third = "";
	foreach($lines2 as $line){
		if(filter($line,$argv[3])){
			print($line."\n");
			$third = get_remote_data(find($line,"href=\"","\""));
		}
	}

	$lines3 = explode("\n",$third);

	$forth = "";
	foreach($lines3 as $line){
		if(filter($line,$argv[4])){
			print($line."\n");
			$forth = get_remote_data(find($line,"href=\"","\""));
		}
	}
	$lines4 = explode("\n",$forth);
	foreach($lines4 as $line){
		if(filter($line,$argv[5])){
			$mp4 = find($line,"href=\"","\"");
			print($mp4."\n");
			if(array_key_exists(6,$argv)){
				$screen = $argv[6];	
			}else{
				$screen = "";
			}
			player($screen,$mp4);
		}
	}
}
