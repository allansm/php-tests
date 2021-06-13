<?php

include("getsource.php");

toGetSource();

foreach(getMp4Links($argv[1]) as $mp4){
	print($mp4."\n");
	download($mp4,"");
}
