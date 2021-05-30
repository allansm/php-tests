<?php

include("import/ttodua.php");
include("../functions/util.php");
include("../functions/fileHandle.php");
include("getsource.php");

toGetSource();

$page = get_remote_data($argv[1]);

foreach(getHttp($page) as $line){
	print($line."\n");
}
/*
$page = str_replace("'","\"",$page);
$page = str_replace("\"","\n\n",$page);

$lines = getLines($page);

foreach($lines as $line){
	if(str_starts_with($line,"http") && !has($line,"\n")){
		print($line."\n");
	}
}
 */
