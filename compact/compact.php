<?php

function getsizemb($file){
	return round((filesize($file)/1024)/1024);
}

function addFile($toadd,$file){
	$data = implode("",file($toadd));
		
	$toadd = basename($toadd);

	file_put_contents($file,bin2hex("$toadd"),FILE_APPEND);
	file_put_contents($file,"@",FILE_APPEND);
	
	file_put_contents($file,bin2hex($data),FILE_APPEND);

	file_put_contents($file,"#",FILE_APPEND);

}

function addFileTest($toadd,$file){
	$data = fopen($toadd,"rb");
	
	$toadd = basename($toadd);

	file_put_contents($file,bin2hex("$toadd"),FILE_APPEND);
	file_put_contents($file,"@",FILE_APPEND);
	
	while(!feof($data)){
		$char = fread($data,10240);
		file_put_contents($file,bin2hex($char),FILE_APPEND);
	}
	file_put_contents($file,"#",FILE_APPEND);

	fclose($data);
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

function extractFilesTest($file){
	$data = fopen($file,"rb");
	$fname = "";
	$colected = "";
	while(!feof($data)){
		$char = fread($data,1);
		
		if($char != "@" && $char != "#"){
			$colected .= $char;
		}
		
		if($char == "@"){
			$fname = hex2bin($colected);
			$colected = "";
			print("$fname\n");
		}
		if($char == "#"){
			if($colected != ""){
				print(hex2bin($colected));
				file_put_contents($fname,hex2bin($colected),FILE_APPEND);
				$colected = "";
			}
			$fname = "";
		}
		if($fname != "" && strlen($colected) == 10240000){
			print(hex2bin($colected));
			file_put_contents($fname,hex2bin($colected),FILE_APPEND);
			$colected = "";
		}
	}
	print("\n");
	fclose($data);
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

function console(){
	$wf = "";

	while(true){
		$op = readline("op:");
		$options = array("add","show","extract","wf","extractAll");
		if($op == "add"){
			$toadd = readline("to add:");
			addFileTest($toadd,$wf);
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
		}else if($op == "extractAll"){
			extractFilesTest($wf);
		}
	}
}

console();
