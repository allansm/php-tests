<?php

include("encrypt.php");

function unlock(){
	$file = file(readline("file:"));
	$key = readline("key:");
	$delimiter = readline("delimiter:");

	$txt = "";

	foreach($file as $line){
		$txt.= useKey($line,$key,$delimiter);
	}

	if(readline("save ?(s/n)") == "s"){
		file_put_contents(readline("file:"),$txt,FILE_APPEND);
	}else{
		echo $txt;
	}
}

unlock();
