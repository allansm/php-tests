<?php

$code = file_get_contents("http://wttr.in");
$code = str_replace("<pre>","@@@\n",$code);
$code = str_replace("┌","@@@\n",$code);

$lines = explode("@@@\n",$code);

//print_r($lines);
$data = $lines[1];

$data = str_replace("<","\n\n",$data);
$data = str_replace(">","\n\n",$data);

unset($lines);

$lines = explode("\n\n",$data);

//print_r($lines);

$place = str_replace("\n","",$lines[0]);

$state = trim($lines[5]);

$temperature = $lines[15].$lines[17];


print("$place\nstate : $state\ntemperature : $temperature");
