<?php

//include("import/ttodua.php");
//include("../functions/util.php");
//include("../functions/fileHandle.php");
include("getsource.php");

toGetSource();

foreach(getHttp($argv[1]) as $line){
	print($line."\n");
	download($line,"");
}

/*
$page = get_remote_data($argv[1]);
$page = str_replace("'","\"",$page);
$page = str_replace("\"","\n\n",$page);

$lines = getLines($page);

foreach($lines as $line){
	if(str_starts_with($line,"http") && !has($line,"\n")){
		download($line,"");
	}
}
 */
