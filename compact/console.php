<?php
include("compact.php");

function args($op,$wf){
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
}

function useArgs($argv){
	if(array_key_exists(1,$argv)){
		$op = $argv[1];

		if(array_key_exists(2,$argv)){
			$wf = $argv[2];
		}
		args($op,$wf);
		die();
	}
}

function console($argv){
	useArgs($argv);

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

console($argv);
