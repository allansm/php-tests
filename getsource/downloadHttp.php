<?php

include("import/ttodua.php");
include("../functions/util.php");
include("../functions/fileHandle.php");
include("getsourceFunctions.php");

toGetSource();

$page = get_remote_data($argv[1]);
$page = str_replace("'","\"",$page);
$page = str_replace("\"","\n\n",$page);

$lines = getLines($page);

foreach($lines as $line){
	if(str_starts_with($line,"http") && !has($line,"\n")){
		download($line,"");
	}
}
