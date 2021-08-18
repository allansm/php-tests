<?php
include("encrypt.php");
$key = $argv[1];#readline("key:");
$delimiter = $argv[2];#readline("delimiter");

$txt = $argv[3];#readline("enter text:");

$result = usePattern($txt,$key,$delimiter);

for($i = 0 ;$i < 2;$i++){
	$result = usePattern($result,$key,$delimiter);

}

print($result);

