<?php

$string = "my  test";

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

function getKeys($b1,$b2){
	$keys = array();

	$len = sizeOf($b1);
	
	for($i=0;$i<$len;++$i){
		$keys[$i] = array_search($b1[$i],$b2);
		unset($b2[$keys[$i]]);
	}
	return $keys;
}

function getLen($bytes){
	$len = sizeOf($bytes);
	
	$l = array();

	for($i=0;$i<$len;++$i){
		$l[$i] = strlen($bytes[$i]);	
	}
	return $l;
}

function getKey($keys,$len){
	$size = sizeOf($keys);
	$string = "";
	for($i=0;$i<$size;$i++){
		$string.=$len[$i]."-".$keys[$i].";";
	}
	return $string;
}

function dec($txt,$k){
	$k = explode(";",$k);
		
	$size = sizeOf($k);

	$bytes = array();
	$keys = array();
	$len = array();
	$shuf = array();

	for($i=0;$i<$size;$i++){
		$tmp = explode("-",$k);
		$key[$i] = $tmp[1];
		$len[$i] = $tmp[0];	
	}
	$it = 0;
	for($i=0;$i<$size;$i++){
		$shuf[$i++] = substr($txt,$it,$len[$i]);
		$it+=$len;
	}
}

$bytes = getBytes($string);

$shuf = $bytes;

shuffle($shuf);

print_r($shuf);

$keys = getKeys($bytes,$shuf);
$len = getLen($shuf);

print_r($keys);
print_r($len);
//print(getKey($keys,$len));
//$exp = explode(";",getKey($keys,$len));

//print_r($exp);

unlink("test.txt");
unlink("test2.txt");

file_put_contents("test.txt",implode("",$shuf), FILE_APPEND);
file_put_contents("test2.txt",getKey($keys,$len),FILE_APPEND);


//print(getString(getBytes($string)));

