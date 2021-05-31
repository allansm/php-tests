<?php

//include("import/ttodua.php");
//include("../functions/util.php");
//include("../functions/fileHandle.php");
include("getsource.php");

toGetSource();


foreach(getHttp($argv[1]) as $line){
	print($line."\n");
}

