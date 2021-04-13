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
			$lines = array();
			foreach($found as $arr){
				$lines[$i] = removeLineBreak($arr[0]);
				print($i++.":".$arr[0]."\n\n");
			}
		}

		else if(strtolower($command) == "show"){
			$i = 0;
			foreach($lines as $line){
				print($i++.":".$line."\n\n");
			}
		}
		
		else if(strtolower($command) == "redirect"){
			$url = $lines[readline("line:")];
			getPage($url);
			return $url;
		}

		else if(strtolower($command) == "add"){
			$add = readline("text to add:");
			$op = readline("start or end(s/e)?");
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
			$tmp = implode("\n",$lines);
			fwrite($f, $tmp);
			fclose($f);
		}
		
		else if(!(strpos(strtolower($command),"lines >") === false)){
			unset($tmp);
			$tmp = explode(" > ",$command)[1];
			if(isset($tmp)){
				$f = fopen($tmp, 'w');
				$tmp = implode("\n",$lines);
				fwrite($f,$tmp);
				fclose($f);
				print("stored.\n");
			}
		}
		
		else if(!(strpos(strtolower($command),"ls ") === false)){
			unset($tmp);
			$tmp = explode(" ",$command);
			unset($tmp[0]);
			$tmp = implode(" ",$tmp);
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
			if(isset($tmp)){
				exec($tmp);
			}
		}

		else if(!(strpos(strtolower($command)," : ") === false)){
			unset($tmp);
			$tmp = explode(" : ",$command);
			$i = 0;
			foreach($lines as $line){
				if($i >= intval($tmp[0]) && $i <= intval($tmp[1])){
					print($i.":".$line."\n\n");
				}
				$i++;
			}
		}

		else if(!(strpos(strtolower($command)," - ") === false)){
			unset($tmp);
			$tmp = explode(" - ",$command);
			$i = 0;
			$new = array();
			$arri = 0;
			foreach($lines as $line){
				if($i >= intval($tmp[0]) && $i <= intval($tmp[1])){
					$new[$arri++] = $line;
					print($i.":".$line."\n\n");
				}
				$i++;
			}
			unset($lines);
			$lines = $new;
		}

		else if(strtolower($command) == "download"){
			$dld = $lines[readline("line:")];
			download($dld);
		}
		
		else if(!(strpos(strtolower($command)," @ ") === false)){
			unset($tmp);
			$tmp = explode(" @ ",$command);
			$i = 0;
			print($tmp[0]." ".$tmp[1]);
			foreach($lines as $line){
				if($i >= intval($tmp[0]) && $i <= intval($tmp[1])){
					download($line);
				}
				$i++;
			}
		}
		
		else if(strtolower($command) == "exitpage"){
			return "";
		}
		else if(strtolower($command) == "exit"){
			die("bye :D");
		}
		else if(strtolower($command) == "help"){
			print(file_get_contents( "howto.txt" )."\n");
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
	}

	else if(strtolower($command) == "openpage"){
		$url =  readline("url:");
		getPage($url);
		$url = isset($url)?$url:temp2;
		$return = storeDump(temp2,$url);
		while(true){
			if($return != ""){
				$return = storeDump(temp2,$return);
			}else{
				break;
			}
		}
	}

	else if(strtolower($command) == "open"){
		$fn = readline("file path:");
		storeDump($fn,$url);
	}

	else if(strtolower($command) == "download"){
		download(readline("url:"));
	}
		
	else if(!(strpos(strtolower($command),"ls ") === false)){
		unset($tmp);
		$tmp = explode(" ",$command);
		unset($tmp[0]);
		$tmp = implode(" ",$tmp);
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
		if(isset($tmp)){
			exec($tmp);
		}
	}
	
	else if(strtolower($command) == "exit"){
		die("bye :D");
	}

	else if(strtolower($command) == "help"){
		print(file_get_contents( "howto.txt" )."\n");
	}

}
