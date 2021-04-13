<?php

include("encrypt.php");

function funnyThing(){
	$alphabet = getAlphabet(readline("key:"));

	$fun = array();

	$bytes = getBytes("i need money or i will die x.x");

	$i =0;

	foreach($bytes as $tmp){
		$fun[$i++] = encry($tmp,$alphabet);	
	}
	
	echo implode("-",$fun)."\n";

	$alot = array();

	$i=0;
	foreach($fun as $tmp){
		$alot[$i++] = decry($tmp,$alphabet);	
	}

	print(getString($alot));
}

function funnyThing2(){
	$arr = enc("i will be encrypted :D");
	print("enc:".$arr[1]."\n");
	print("dec:".dec($arr[1],$arr[0]));
}

function funnyThing3(){
	$arr = array();
	$arr[0] = usePattern(readline("to encrypt:"),readline("key:"),readline("delimiter:"));
	$arr[1] = useKey($arr[0],readline("key:"),readline("delimiter:"));

	print_r($arr);
}

function test(){
	$file = file(readline("file to test:"));
	$key = readline("key:");
	$delimiter = readline("delimiter:");
	
	foreach($file as $line){
		file_put_contents("enc.txt",usePattern($line,$key,$delimiter)."\n",FILE_APPEND);
	}
}
function test2(){
	$file = file(readline("file to test:"));
	$key = readline("key:");
	$delimiter = readline("delimiter");
	
	$txt = "";

	foreach($file as $line){
		#print_r(useKey($line,$key,$delimiter));
		$alphabet = getAlphabet($key);
		$encry = explode($delimiter,$line);

		foreach($encry as $enc){
			$txt.=chr(decry($enc,$alphabet));
		}
	}
	file_put_contents("dec.txt",$txt,FILE_APPEND);
}
function test3(){
	$file = file(readline("file to test:"));
	$key = readline("key:");
	$delimiter = readline("delimiter");

	//$alphabet = getAlphabet($key);

	$txt = "";

	foreach($file as $line){
		$txt.= useKey($line,$key,$delimiter);
	}
	file_put_contents("dec.txt",$txt,FILE_APPEND);

}
$op = readline("0-1:");
if($op == 0){
	test();
}else{
	test3();
}
#funnyThing3();
