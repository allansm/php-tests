<?php

include("encrypt.php");

function test(){
	//$file = file(readline("file to test:"));
	$key = readline("key:");
	$delimiter = readline("delimiter");
	
	//$enc = usePattern(readline("file:"),$key,$delimiter);

	$file = file(readline("file:"));
		
	$op = readline("save ?(s/n):");

	if($op == "s"){
		//file_put_contents(readline("file:"));
		$fname = readline("file:");
		
		foreach($file as $line){
			file_put_contents($fname,usePattern($line,$key,$delimiter)."\n",FILE_APPEND);
		}
	}else{
		foreach($file as $line){
			//file_put_contents("enc.txt",usePattern($line,$key,$delimiter)."\n",FILE_APPEND);
			echo usePattern($line,$key,$delimiter);
		}
	}
}
test();
