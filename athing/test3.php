<?php

include("../functions/util.php");
include("../functions/fileHandle.php");

tempWdir("athing");

$lines = array_unique(file(".log"));

foreach($lines as $line){
	if(has($line,"http") && has($line,".mp4")){
		print($line);
	}
}
