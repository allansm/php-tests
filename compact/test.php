<?php

function getBytes($string){
	$bytes = array();
	$len = strlen($string);

	for($i=0;$i<$len;++$i){
		$bytes[$i] = ord($string[$i]);
	}
	return $bytes;
}

function getString($bytes){
	$len = sizeOf($bytes);
	$string = "";
	for($i=0;$i<$len;++$i){
		$string.= chr($bytes[$i]);
	}
	return $string;
}
function writeBytes($bytes,$file){
	foreach($bytes as $byte){
		file_put_contents($file,$byte." ",FILE_APPEND);	
	}
}

function addFile($toadd,$file){
	$basename = basename($toadd);
	writeBytes(getBytes($basename),$file);
	file_put_contents($file,"\n\n",FILE_APPEND);

	$tmp = file($toadd);

	foreach($tmp as $line){
		writeBytes(getBytes($line),$file);
	}
	file_put_contents($file,"\n#\n",FILE_APPEND);
}

function test($file){
	$tmp = file($file);
	foreach($tmp as $line){
		$line = str_replace("\n","",$line);
		$bytes = explode(" ",$line);
		$bytes = array_diff($bytes,[""," "]);
		//print_r($bytes);
		echo getString($bytes)."\n";
	}
}

function test2($file){
	$tmp = file($file);
	$imp = implode("",$tmp);
	$files = explode("#",$imp);
	foreach($files as $f){
		$lines = explode("\n",$f);
		$lines = array_diff($lines,[""," "]);
		$lines = array_values($lines);
		
		$filename = "";
		$text = "";
		if(array_key_exists(0,$lines)){
			$fnbytes = explode(" ",$lines[0]);
			$fnbytes = array_diff($fnbytes,[""," "]);
			//$fnbytes = array_values($fnbytes);
			//print_r($fnbytes);
			
			$filename = getString($fnbytes);
		}
		unset($lines[0]);
		foreach($lines as $line){
			//print("$line\n");
			$line = str_replace("\n","",$line);
			$bytes = explode(" ",$line);
			$bytes = array_diff($bytes,[""," "]);
			$text.=getString($bytes);
		}
		if($filename != ""){
			file_put_contents($filename,$text);
		}
	}
}

//addFile("test.png","test.compact");

test2("test.compact");
