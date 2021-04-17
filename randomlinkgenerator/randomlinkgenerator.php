<?php

include("../functions/util.php");
include("../functions/fileHandle.php");
include("../functions/time.php");


function copyLinks(){
	if(file_exists("links.txt")){
		unlink("links.txt");
	}
	$linkspath = removeLineBreak(file(".config")[0]);

	$links = file($linkspath);

	shuffle($links);
	
	createFile("links.txt");

	foreach($links as $link){
		print($link);
		file_put_contents("links.txt",$link,FILE_APPEND);
	}
}

function resolveLink($link){
	$command = removeLineBreak(file(".config")[1])." \"".removeLineBreak($link)."\" > redirect.txt";

	print($command."\n");

	exec($command);
}


function run(){
	$starttime = timeToMillis();

	while(true){
		//echo chr(27).chr(91).'H'.chr(27).chr(91).'J';
		clean();
		echo toSec(elapsed($starttime));

		
		if(file_exists("links.txt")){
			
			if(file("links.txt")[0] == ""){
				copyLinks();
			}else{
				if( toSec( elapsed($starttime) ) == 900){
					$starttime = timeToMillis();

					consumeLine("redirect.txt",0);
				}

				$redirect = "";
				$redirect = @file("redirect.txt")[0];
				if($redirect == "")
					resolveLink(consumeLine("links.txt",0));
			}
		}else{
			copyLinks();
		}
	}
}

run();
