<?php

include("getsource.php");

toGetSource();

foreach(getHttp($argv[1]) as $line){
	print($line."\n");
	download($line,"");
}

