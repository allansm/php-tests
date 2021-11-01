<?php

include("getsource.php");

foreach(getMp4Links($argv[1]) as $link){
	print("$link\n");
}

print("\n");
foreach(getHttp($argv[1]) as $link){
	foreach(getMp4Links($argv[1]) as $link){
		print("$link\n");
	}
	print("\n");	
}
