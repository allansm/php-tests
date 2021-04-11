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

funnyThing3();
