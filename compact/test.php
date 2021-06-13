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
	file_put_contents($file,"\n\n",FILE_APPEND);
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

addFile("b.txt","test2.compact");

//test("test.compact");
