<?php

$a = "1324";

$n = intval($argv[1]);
print(strlen($a)."\n");
$res = "";
while($n > 0){	
	print($n%strlen($a));
	print(" ");
	print(intval($n/strlen($a))."\n");
	
	$res=$a[$n%strlen($a)].$res;
	$n = intval($n/strlen($a));	
}

print($res);
