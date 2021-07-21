<?php

include("compact.php");

$op = $argv[1];

if(array_key_exists(2,$argv)){
	$wf = $argv[2];
}

$options = array("--add","--show","--extract","--extract-all");

if($op == "--add"){
	$toadd = readline("to add:");
	addFile($toadd,$wf);
}else if($op == "--show"){
	print_r(showFiles($wf));
}else if($op == "--help"){
	foreach($options as $o){
		print("$o\n");
	}
}else if($op == "--extract-all"){
	extractFiles($wf);
}else if($op == "--extract"){
	extractByName($wf,$argv[3]);
}

