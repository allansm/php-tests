<?php

include("browserFunctions.php");

function storeDump($fn,$url){
	$dump = "";
	$found = array();
	$lines = array();
	
	$dump = file($fn);
	$lines = $dump;
	while(true){
		
		$url = isset($url)?$url:$fn;
		$command = readline($url.">");
		if(strtolower($command) == "find"){
			$tmp = implode("",$dump);
			
			$p1 =  readline("start:");
			$p2 =  readline("end:");
			
			$found = find($tmp,$p1,$p2);
			$i = 0;
			unset($lines);
			foreach($found as $arr){
				$lines[$i] = $arr[0];
				print($i++.":".$arr[0]."\n\n");
			}
		}
		else if(strtolower($command) == "showlines"){
			$i = 0;
			foreach($lines as $line){
				print($i++.":".$line."\n\n");
			}
		}
		
		else if(strtolower($command) == "redirecttoline"){
			$url = $lines[readline("line:")];
			getPage($url);
			//storeDump(temp2,$url);
			return $url;
			//$redirect = true;
			//break;
		}
		else if(strtolower($command) == "addtolines"){
			$add = readline("text to add:");
			$op = readline("start or end(s/e)?");
			//unset($tmp);
			$tmp2 = array();
			if($op == "s"){
				$i = 0;
				foreach($lines as $line){
					$tmp2[$i++] = $add.$line;
				}
			}else{
				$i = 0;
				foreach($lines as $line){
					$tmp2[$i++] = $line.$add;
				}
			}
			$lines = $tmp2;
		}
		
		else if(strtolower($command) == "lines > dump"){
			$f = fopen(temp2, 'w');
			$tmp = implode("",$lines);
			fwrite($f, $tmp);
			fclose($f);
		}
		
		else if(!(strpos(strtolower($command),"lines >") === false)){
			unset($tmp);
			$tmp = explode(" > ",$command)[1];
			if(isset($tmp)){
				$f = fopen($tmp, 'w');
				$tmp = implode("",$lines);
				fwrite($f, $tmp);
				fclose($f);
				print("stored.\n");
			}
		}
		
		else if(!(strpos(strtolower($command),"ls ") === false)){
			unset($tmp);
			$tmp = explode(" ",$command);
			unset($tmp[0]);
			$tmp = implode(" ",$tmp);
			//print($tmp);
			if(isset($tmp)){
				$tmp = scandir($tmp);
				if(isset($tmp)){
					print_r($tmp);
				}
			}
		}
		
		else if(!(strpos(strtolower($command),"run ") === false)){
			unset($tmp);
			$tmp = explode(" ",$command);
			unset($tmp[0]);
			$tmp = implode(" ",$tmp);
			//print($tmp);
			if(isset($tmp)){
				exec($tmp);
			}
		}
		
		else if(strtolower($command) == "exitpage"){
			//break;
			return "";
		}
		else if(strtolower($command) == "exit"){
			die("bye :D");
		}
	}
}

$redirect = false;

while(true){
	if(!$redirect){
		$command = readline("cbrowser>");
	}else{
		getPage($url);
		$command = "storedump";
		$redirect = false;
	}
	if(strtolower($command) == "seturl"){
		$url =  readline("url:");
	}
	
	else if(strtolower($command) == "getpage"){
		getPage($url);
	}
	else if(strtolower($command) == "storedump"){
		$url = isset($url)?$url:temp2;
		$return = storeDump(temp2,$url);
		while(true){
			if($return != ""){
				$return = storeDump(temp2,$return);
			}else{
				break;
			}
		}
		/*$dump = file(temp2);
		$lines = $dump;
		while(true){
			
			$url = isset($url)?$url:temp2;
			$command = readline($url.">");
			if(strtolower($command) == "find"){
				$tmp = implode("",$dump);
				
				$p1 =  readline("start:");
				$p2 =  readline("end:");
				
				$found = find($tmp,$p1,$p2);
				$i = 0;
				foreach($found as $arr){
					$lines[$i] = $arr[0];
					print($i++.":".$arr[0]."\n\n");
				}
			}
			else if(strtolower($command) == "showlines"){
				$i = 0;
				foreach($lines as $line){
					print($i++.":".$line."\n\n");
				}
			}
			
			else if(strtolower($command) == "redirecttoline"){
				$url = $lines[readline("line:")];
				$redirect = true;
				break;
			}
			else if(strtolower($command) == "addtolines"){
				$add = readline("text to add:");
				$op = readline("start or end(s/e)?");
				$tmp = array();
				if($op == "s"){
					$i = 0;
					foreach($lines as $line){
						$tmp[$i++] = $add.$line;
					}
				}else{
					$i = 0;
					foreach($lines as $line){
						$tmp[$i++] = $line.$add;
					}
				}
				$lines = $tmp;
			}
			
			else if(strtolower($command) == "lines > dump"){
				$f = fopen(temp2, 'w');
				$tmp = implode("",$lines);
				fwrite($f, $tmp);
				fclose($f);
			}
			
			else if(!(strpos(strtolower($command),"lines >") === false)){
				unset($tmp);
				$tmp = explode(" > ",$command)[1];
				if(isset($tmp)){
					$f = fopen($tmp, 'w');
					$tmp = implode("",$lines);
					fwrite($f, $tmp);
					fclose($f);
					print("stored.\n");
				}
			}
			
			else if(strtolower($command) == "exitpage"){
				break;
			}
			else if(strtolower($command) == "exit"){
				die("bye :D");
			}
		}*/
	}
	else if(strtolower($command) == "open"){
		$fn = readline("file path:");
		storeDump($fn,$url);
	}
	
	else if(!(strpos(strtolower($command),"ls ") === false)){
		unset($tmp);
		$tmp = explode(" ",$command);
		unset($tmp[0]);
		$tmp = implode(" ",$tmp);
		//print($tmp);
		if(isset($tmp)){
			$tmp = scandir($tmp);
			if(isset($tmp)){
				print_r($tmp);
			}
		}
	}
	
	else if(!(strpos(strtolower($command),"run ") === false)){
		unset($tmp);
		$tmp = explode(" ",$command);
		unset($tmp[0]);
		$tmp = implode(" ",$tmp);
		//print($tmp);
		if(isset($tmp)){
			exec($tmp);
		}
	}
	
	else if(strtolower($command) == "exit"){
		die("bye :D");
	}
}