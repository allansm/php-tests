<?php

include("encrypt.php");

function lock(){
	$key = readline("key:");
	$delimiter = readline("delimiter");

	if(readline("use file ?(s/n)") == "s"){

		$file = file(readline("file:"));

	
		if(readline("save ?(s/n):") == "s"){
			$fname = readline("file:");
			
			foreach($file as $line){
				file_put_contents($fname,usePattern($line,$key,$delimiter)."\n",FILE_APPEND);
			}
		}else{
			foreach($file as $line){
				echo usePattern($line,$key,$delimiter);
			}
		}

	}else{
		$txt = readline("enter text:");
		if(readline("save ?(s/n):") == "s"){
			$fname = readline("file:");
			file_put_contents($fname,usePattern($txt,$key,$delimiter)."\n",FILE_APPEND);
		}else{
			echo usePattern($txt,$key,$delimiter);
		}
	}		
}
lock();
