<?php

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

function addFile($toadd,$file){
	$basename = basename($toadd);
	writeBytes(getBytes($basename),$file);
	file_put_contents($file,"\n\n",FILE_APPEND);

	$tmp = file($toadd);

	foreach($tmp as $line){
		writeBytes(getBytes($line),$file);
	}
	file_put_contents($file,"\n#\n",FILE_APPEND);
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

function test4($toadd,$file){
	$lines = file($toadd);
	
	file_put_contents($file,bin2hex("$toadd"),FILE_APPEND);
	file_put_contents($file,"\n",FILE_APPEND);

	foreach($lines as $line){
		file_put_contents($file,bin2hex($line)."\n",FILE_APPEND);
	}
	file_put_contents($file,"#\n",FILE_APPEND);

}

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

//addFile("test.png","test.compact");
//test4("test.zip","test.compact");
//test5("test.compact");
test6("test.compact");
//test2("test.compact");
