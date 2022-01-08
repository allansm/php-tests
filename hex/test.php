<?php

$hex = strtoupper(bin2hex(implode("\n",file($argv[1]))));

$c = 0;
$x = -1;
$n = 0;

if(array_key_exists(2,$argv)){
	$x = intval($argv[2]);
}

for($i = 0;$i < strlen($hex);$i++){	
	print($hex[$i]);
	
	if($c++ == 1){
		print(" ");
		$c=0;
	}

	if($n++ == $x*2-1){
		print("\n");
		$n = 0;
	}
}
