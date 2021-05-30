<?php

include("import/ttodua.php");
include("../functions/util.php");
include("../functions/fileHandle.php");
include("getsource.php");

$page = get_remote_data($argv[1]);
$page = str_replace("'","\"",$page);
$page = str_replace("\"","\n\n",$page);

$lines = getLines($page);

foreach($lines as $line){
	if(!has($line,"<") && !has($line,">") && !has($line,"=")){
		print($line."\n");	
	}
}
