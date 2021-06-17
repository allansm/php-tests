<?php
/*
function getBytes($string){
	$bytes = array();
	$len = strlen($string);

	for($i=0;$i<$len;++$i){
		$bytes[$i] = ord($string[$i]);
	}
	return $bytes;
}

function getString($bytes){
	$len = sizeOf($bytes);
	$string = "";
	for($i=0;$i<$len;++$i){
		$string.= chr($bytes[$i]);
	}
	return $string;
}

function writeBytes($bytes,$file){
	foreach($bytes as $byte){
		file_put_contents($file,$byte." ",FILE_APPEND);	
	}
}
function test($file){
	$tmp = file($file);
	foreach($tmp as $line){
		$line = str_replace("\n","",$line);
		$bytes = explode(" ",$line);
		$bytes = array_diff($bytes,[""," "]);
		
		echo getString($bytes)."\n";
	}
}

function test2($file){
	$tmp = file($file);
	$imp = implode("",$tmp);
	$files = explode("#",$imp);
	foreach($files as $f){
		$lines = explode("\n",$f);
		$lines = array_diff($lines,[""," "]);
		$lines = array_values($lines);
		
		$filename = "";
		$text = "";
		if(array_key_exists(0,$lines)){
			$fnbytes = explode(" ",$lines[0]);
			$fnbytes = array_diff($fnbytes,[""," "]);
			
			$filename = getString($fnbytes);
		}
		unset($lines[0]);
		foreach($lines as $line){
			$line = str_replace("\n","",$line);
			
			$text.= test3($line);
		}
		if($filename != ""){
			file_put_contents($filename,$text);
		}
	}
}

function test3($line){
	$len = strlen($line);
	$text = "";
	$byte = "";
	for($i = 0;$i < $len;$i++){
		if($line[$i] == " "){
			$text.=chr($byte);
			$byte = "";
		}else{
			$byte.=$line[$i];
		}
	}
	return $text;
}
 */
function addFile($toadd,$file){
	$data = implode("",file($toadd));
		
	$toadd = basename($toadd);

	file_put_contents($file,bin2hex("$toadd"),FILE_APPEND);
	file_put_contents($file,"@",FILE_APPEND);
	
	file_put_contents($file,bin2hex($data),FILE_APPEND);

	file_put_contents($file,"#",FILE_APPEND);

}

function extractFiles($file){
	$data = file($file)[0];
	$files = explode("#",$data);
	foreach($files as $tmp){
		$tmp2 = explode("@",$tmp);
		$tmp2 = array_diff($tmp2,[""," "]);
		$tmp2 = array_values($tmp2);

		if(array_key_exists(0,$tmp2)){
			$fn = hex2bin($tmp2[0]);	
			file_put_contents($fn,hex2bin($tmp2[1]),FILE_APPEND);	
		}
	}
}

function extractFile($index,$file){
	$data = file($file)[0];
	$files = explode("#",$data);
	$i = 0;
	foreach($files as $tmp){
		$tmp2 = explode("@",$tmp);
		$tmp2 = array_diff($tmp2,[""," "]);
		$tmp2 = array_values($tmp2);
			
		if($i++ == $index)
		if(array_key_exists(0,$tmp2)){
			$fn = hex2bin($tmp2[0]);	
			file_put_contents($fn,hex2bin($tmp2[1]),FILE_APPEND);	
		}
	}
}


function showFiles($file){
	$data = file($file)[0];
	$files = explode("#",$data);
	$arr = [];
	foreach($files as $tmp){
		$tmp2 = explode("@",$tmp);
		$tmp2 = array_diff($tmp2,[""," "]);
		$tmp2 = array_values($tmp2);

		if(array_key_exists(0,$tmp2)){
			$fn = hex2bin($tmp2[0]);
			array_push($arr,$fn);
		}
	}
	print_r($arr);
}

function showContent($index,$file){
	$data = file($file)[0];
	$files = explode("#",$data);
	$i = 0;
	foreach($files as $tmp){
		$tmp2 = explode("@",$tmp);
		$tmp2 = array_diff($tmp2,[""," "]);
		$tmp2 = array_values($tmp2);
		
		if($i++ == $index)
		if(array_key_exists(0,$tmp2)){
			print($tmp2[1]);
			print("\n");
			print(hex2bin($tmp2[1]));
		}
	}
	
}

/*
function test5($file){
	$data = implode("\n",file($file));
	$files = explode("#",$data);
	foreach($files as $tmp){
		$tmp2 = explode("\n",$tmp);
		$tmp2 = array_diff($tmp2,[""," "]);
		$tmp2 = array_values($tmp2);

		if(array_key_exists(0,$tmp2)){
			$fn = hex2bin($tmp2[0]);
			unset($tmp2[0]);
			foreach($tmp2 as $line){
				file_put_contents($fn,hex2bin($line)."\n",FILE_APPEND);
			}
		}
	}	

}

function test6($file){
	$data = implode("\n",file($file));
	$files = explode("#",$data);
	$fns = [];
	foreach($files as $tmp){
		$tmp2 = explode("\n",$tmp);
		$tmp2 = array_diff($tmp2,[""," "]);
		$tmp2 = array_values($tmp2);

		if(array_key_exists(0,$tmp2)){
			$fn = hex2bin($tmp2[0]);
			array_push($fns,$fn);
		}
	}
	print_r($fns);
	$index = readline("select number to extract:");
	
	$tmp = $files[$index];	

	$tmp2 = explode("\n",$tmp);
	$tmp2 = array_diff($tmp2,[""," "]);
	$tmp2 = array_values($tmp2);

	if(array_key_exists(0,$tmp2)){
		$fn = hex2bin($tmp2[0]);
		array_push($fns,$fn);
		unset($tmp2[0]);
		foreach($tmp2 as $line){
			file_put_contents($fn,hex2bin($line)."\n",FILE_APPEND);
		}
	}	
}
 */
function console(){
	$wf = "";

	while(true){
		$op = readline("op:");
		$options = array("add","show","extract","wf");
		if($op == "add"){
			$toadd = readline("to add:");
			addFile($toadd,$wf);
		}else if($op == "show"){
			showFiles($wf);
		}else if($op == "extract"){
			$index = readline("index:");
			extractFile($index,$wf);
		}else if($op == "wf"){
			$wf = readline("work file:");	
		}else if($op == "help"){
			foreach($options as $o){
				print("$o\n");
			}
		}
	}
}

console();
