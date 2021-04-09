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
	$data = explode(";",$k);
		
	$size = sizeOf($data)-1;

	$b = array();
	$keys = array();
	$len = array();
	$shuf = array();

	for($i=0;$i<$size;$i++){
		$tmp = explode("-",$data[$i]);
		print_r($tmp);
		$key[$i] = $tmp[1];
		$len[$i] = $tmp[0];	
	}
	for($i=0;$i<$size;$i++){
		print($txt."\n");
		$shuf[$i] = substr($txt,0,$len[$i]);
		$txt = substr_replace($txt, "",0, $len[$i]);//str_replace($shuf[$i],"",$txt);
		
	}
	for($i=0;$i<$size;$i++){
		$b[$i] = $shuf[$key[$i]];
	}
	print_r($shuf);
	print(getString($b));
}
function enc($txt){
	$bytes = getBytes($txt);

	$shuf = $bytes;
	
	shuffle($shuf);
	
	$arr = array();
	
	$arr[0] = getKey(getKeys($bytes,$shuf),getLen($shuf));
	$arr[1] = implode($shuf);

	return $arr;	
}

/*$bytes = getBytes($string);

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

file_put_contents("test.txt",implode("",$shuf), file_append);
file_put_contents("test2.txt",getkey($keys,$len),file_append);

$txt = implode("",$shuf);
 */
unlink("test.txt");
unlink("test2.txt");

$arr = enc("i gonna eat your cancer");
print_r($arr);

file_put_contents("test2.txt",$arr[0], FILE_APPEND);
file_put_contents("test.txt",$arr[1], FILE_APPEND);


dec(file("test.txt")[0],file("test2.txt")[0]);

//print(getString(getBytes($string)));

