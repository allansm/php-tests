<?php

include("import\\ttodua.php");
include("../functions/ff.php");
include("../functions/util.php");
include("../functions/mpv.php");
include("../functions/fileHandle.php");

function filter($txt,$pattern){	
	return hasPattern($txt,$pattern);
}

tempWdir("athing");

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
	file_put_contents(".log",$links[0]."\n",FILE_APPEND);
	
	$second = get_remote_data($links[0]);

	$lines2 = explode("\n",$second);


	$third = "";
	foreach($lines2 as $line){
		if(filter($line,$argv[3])){
			$fnd = find($line,"href=\"","\"");
			print("$fnd\n");
			$third = get_remote_data($fnd);
		}
	}

	$lines3 = explode("\n",$third);

	$forth = "";
	foreach($lines3 as $line){
		if(filter($line,$argv[4])){
			$fnd = find($line,"href=\"","\"");
			print("$fnd\n");
			$forth = get_remote_data($fnd);
		}
	}
	$lines4 = explode("\n",$forth);
	
	foreach($lines4 as $line){
		if(filter($line,$argv[5])){
			$mp4 = find($line,"href=\"","\"");
			
			print("\n");
			print($mp4."\n");
			file_put_contents(".log","$mp4\n\n",FILE_APPEND);

			if(array_key_exists(6,$argv)){
				$screen = $argv[6];	
			}else{
				$screen = "";
			}
			
			mpv($screen,$mp4);
		}
	}
}
