<?php

//example
function bufferedCopy($from, $to,$mb) {
    //$buffer_size = 1048576*$mb; 
	$buffer_size = 1048;
    $rbt = 0;
	
    $fileIn = fopen($from, "rb");
    $fileOut = fopen($to, "w");
	
    while(!feof($fileIn)) {
        $rbt += fwrite($fileOut, fread($fileIn, $buffer_size));
    }
	
    fclose($fileIn);
    fclose($fileOut);
	
    return $rbt;
}

function test(){
	$file = fopen("test.txt","rb");
	$text = "";
	while(!feof($file)){
		$char = fread($file,1);
		$text .= $char;
		if($char == "#"){
			die("$text\n");
			$text = "";
		}
	}
}
/*function test2(){
	$file = fopen("test.txt","rb");
	$text = "";
	while(!feof($file)){
		$bts = fread($file,102400);
		$text .= $char;
		if($char == "#"){
			die("$text\n");
			$text = "";
		}
	}
}*/

function test3(){
	$file = fopen("test.txt","rb");
	$b = 1;
	$bc = 0;
	$loc = array();
	while(!feof($file)){
		$char = fread($file,$b);
		if($char == "#"){
			array_push($loc,$bc);	
		}
		$bc+=$b;
	}
	print_r($loc);
}

function test4($skip,$b){
	$file = fopen("test.txt","rb");
	if($skip != 0){
		$skip = fread($file,$skip);

	}
	while(!feof($file)){
		$text = fread($file,$b);
		print($text);
		break;
	}	
}

function hugeText(){
	$huge = "";
	for($i = 0;$i<=10240000;$i++){
		$huge.="9";
	}
}
//hugeText();
//test();
test3();

test4(0,11);
test4(11,21);


