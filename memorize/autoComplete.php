<?php

include("../functions/util.php");

$words = array();
$words = $argv;

unset($words[0]);

$line = implode(" ",$words);

try{
	$memorized = file(__DIR__."/.memorized");
	
	foreach($memorized as $mem){
		if(!(strpos($mem, $line) === false)){
			if($line != ""){
				print($mem);
				die();
			}
		}
	}
}catch(exception $e){}

print(removeLineBreak($line));

