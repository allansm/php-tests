<?php

include("encrypt.php");

function unlock(){
	$key = readline("key:");
	$delimiter = readline("delimiter");
	
	$file = file(readline("file:"));
		
	$op = readline("save ?(s/n):");

	if($op == "s"){
		$fname = readline("file:");
		
		foreach($file as $line){
			file_put_contents($fname,usePattern($line,$key,$delimiter)."\n",FILE_APPEND);
		}
	}else{
		foreach($file as $line){
			echo usePattern($line,$key,$delimiter);
		}
	}
}
unlock();
