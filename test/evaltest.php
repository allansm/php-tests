<?php
function old(){
	$exp = "return (2.5+3)/2;";

	print(eval($exp));
}

$test = "66 75 6e 63 74 69 6f 6e 20 68 65 6c 6c 6f 28 29 7b 70 72 69 6e 74 28 27 68 65 6c 6c 6f 77 6f 72 6c 64 27 29 3b 7d";
$tmp = "";
foreach(explode(" ",$test) as $n){
	$tmp.=hex2bin($n);	
}

eval($tmp);
$tmp = null;

hello();
