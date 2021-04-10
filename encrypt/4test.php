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
	//print_r($fun);
	echo implode("-",$fun)."\n";

	$alot = array();

	$i=0;
	foreach($fun as $tmp){
		$alot[$i++] = decry($tmp,$alphabet);	
	}

	//print_r($alot);
	print(getString($alot));
}

function funnyThing2(){
	$arr = enc("i will be encrypted :D");
	print("enc:".$arr[1]."\n");
	print("dec:".dec($arr[1],$arr[0]));
}

funnyThing();
print("\n\n");
funnyThing2();

