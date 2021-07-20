<?php

function console(){
	$wf = "";
	$fnames = "";
	while(true){
		$op = readline("op:");
		$options = array("add","show","extract","wf","extractAll");
		if($op == "add"){
			$toadd = readline("to add:");
			addFile($toadd,$wf);
		}else if($op == "show"){
			
			if($fnames == ""){
				$fnames = showFiles($wf);
			}
			print_r($fnames);
		}else if($op == "extract"){
			$index = readline("index:");
			
			extractFile($wf,$index);
		}else if($op == "wf"){
			$wf = readline("work file:");
			$fnames = "";
		}else if($op == "help"){
			foreach($options as $o){
				print("$o\n");
			}
		}else if($op == "extractAll"){
			
			extractFiles($wf);
		}else if($op == "extractByName"){
			extractByName($wf,readline("name:"));
		}

	}
}

console();
