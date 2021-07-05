<?php
include("../functions/util.php");

$code = file_get_contents("http://wttr.in");
$code = str_replace("<pre>","@@@\n",$code);
$code = str_replace("┌","@@@\n",$code);

$lines = explode("@@@\n",$code);

$data = $lines[1];

$data = str_replace("<","\n\n",$data);
$data = str_replace(">","\n\n",$data);

unset($lines);

$lines = explode("\n\n",$data);

$place = str_replace("\n","",$lines[0]);
$place = explode(":",$place)[1];

$state = trim($lines[5]);

$i = 0;
foreach($lines as $line){
	if(has($line,"°C")){
		break;			
	}
	$i++;
}

$temperature = $lines[$i-2].$lines[$i];


print("place : $place\nstate : $state\ntemperature : $temperature");

