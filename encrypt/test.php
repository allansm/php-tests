<?php

include("encrypt.php");


$key = $argv[1];
$del = $argv[2];
$f1  = $argv[3];
$f2  = $argv[4];

$new = "";

foreach(file($f1) as $line){
	$new .= useKey($line,$key,$del);
}

$a = explode(" ",$new)[0];
$b = explode(" ",$new)[1];

$final = "";

foreach(file($f2) as $line){
	$final .= useKey($line,$a,$b);
}

print($final);
