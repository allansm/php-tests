<?php

$socket = fsockopen("www.google.com", 80, $errno, $errstr, 20);
 
$h = "GET / HTTP/1.1\r\n";
$h .= "Host: www.google.com\r\n";
$h .= "Connection: Close\r\n\r\n";

fwrite($socket, $h);

$data = "";
while(!feof($socket)){
	$data .= fgets($socket, 1024);
}

fclose($socket); 

print($data);
