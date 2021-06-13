<?php

include("getsource.php");

foreach(getMp4Links($argv[1]) as $mp4){
	print($mp4."\n");
}
