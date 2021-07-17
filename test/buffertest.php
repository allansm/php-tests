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
	$loc = [];
	$start = 0;
	$i = 0;
	$txt = "";
	while(!feof($file)){
		$char = fread($file,$b);
		$txt.=$char;
		if($char == "#"){
			$loc[$i]["start"] = $start;
			$loc[$i]["end"] = $bc;
			$loc[$i++]["len"] = strlen($txt);
			$start = $bc;
			$txt = "";
		}
		if($char != ""){
//			echo "$char $bc\n";
			$bc+=$b;
			//$lastchar = $char;
		}
	}
	print_r($loc);
}

function test4($skip,$b){
	$file = fopen("test.txt","rb");
	while(!feof($file)){
		if($skip != 0){
			$skip+=1;
			$skipped = fread($file,$skip);

		}
		$b = $b-$skip;
		if($skip == 0){
			$b-=1;
		}/*else{
			$b+=1;
			}*/
		$text = fread($file,$b);
		print($text);
		fclose($file);
		break;
	}	
}

function test5(){
	$file = fopen("test.txt","rb");
	$arr = [];
	while(!feof($file)){
		array_push($arr,fread($file,1));
	}
	print_r($arr);
}

function hugeText(){
	$huge = "";
	for($i = 0;$i<=10240000;$i++){
		$huge.="9";
	}
	return $huge;
}
//hugeText();
//test();
test3();
//echo hugeText();
test4(0,11);
print("\n");
test4(10,16);
print("\n");
test4(16,19);
//test5();
