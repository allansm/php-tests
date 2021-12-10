<?php
function println($txt){
	print("$txt\n");
}

function test($txt,$n,$base){
	for($i=0;$i<$n;$i++){
		$txt=$base($txt);
	}
	
	return $txt;
}

$a = base64_encode("hello");
$b64 = $a;
println($a);
$a = base64_decode($a);
println($a);
$tmp = function($txt){
	return base64_encode($txt);
};

$tmp2 = function($txt){
	return base64_decode($txt);
};

$t = test("hello",5,$tmp);
println($t);

$t = test($t,5,$tmp2);
println($t);
