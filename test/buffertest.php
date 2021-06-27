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
test();
