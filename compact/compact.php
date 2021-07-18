<?php
include("../functions/util.php");


function getsizemb($file){
	return round((filesize($file)/1024)/1024);
}

function addFile($toadd,$file){
	$data = fopen($toadd,"rb");
	
	$toadd = basename($toadd);

	file_put_contents($file,bin2hex("$toadd"),FILE_APPEND);
	file_put_contents($file,"@",FILE_APPEND);
	
	while(!feof($data)){
		$char = fread($data,102400);
		file_put_contents($file,bin2hex($char),FILE_APPEND);
	}
	file_put_contents($file,"#",FILE_APPEND);

	fclose($data);
}

function extractFiles($file){
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
		}
		if($char == "#"){
			if($colected != ""){
				file_put_contents($fname,hex2bin($colected),FILE_APPEND);
				$colected = "";
			}
			$fname = "";
		}
		if($fname != "" && strlen($colected) == 10240000){
			
			file_put_contents($fname,hex2bin($colected),FILE_APPEND);
			$colected = "";
		}
	}

	fclose($data);
}

function extractFilesTest($file,$index){
	$data = fopen($file,"rb");
	$fname = "";
	$colected = "";
	$tmp = "";
	while(!feof($data) || $colected != ""){
		$b = fread($data,10240000);	
		$colected .= $b;
		if(has($colected,"@") && $fname == ""){
			$bname = explode("@",$colected)[0];
			$fname = hex2bin($bname);
			$colected = str_replace("$bname@","",$colected);
			
		}
		if(has($colected,"#")){
			$tmp = explode("#",$colected)[0];
			if($tmp != "" && !has($tmp,"#")){
				
				file_put_contents($fname,hex2bin($tmp),FILE_APPEND);
				$fname = "";
				$colected = str_replace("$tmp#","",$colected);
			}
		}
		if($fname != "" && $colected != ""){
			while(!(strlen($colected) % 2 == 0)){
				$b = fread($data,1);
				$colected.=$b;
			}
			file_put_contents($fname,hex2bin($colected),FILE_APPEND);
			$colected = "";
		}
	}
}


function extractFile($index,$file){
	$data = fopen($file,"rb");
	$fname = "";
	$colected = "";
	$i = 0;
	while(!feof($data)){
		$char = fread($data,1);
		
		if($char != "@" && $char != "#"){
			$colected .= $char;
		}
		
		if($char == "@"){
			$fname = hex2bin($colected);
			$colected = "";
		}
		if($char == "#"){
			if($colected != ""){
				if($index == $i){
					file_put_contents($fname,hex2bin($colected),FILE_APPEND);
				}
				$colected = "";
			}
			$fname = "";
			$i++;
		}
		if($fname != "" && strlen($colected) == 10240000 && $index == $i){
			file_put_contents($fname,hex2bin($colected),FILE_APPEND);
			$colected = "";
		}
	}
	fclose($data);
}

function extractFileTest($file,$index){
	$data = fopen($file,"rb");
	$fname = "";
	$colected = "";
	$tmp = "";
	$i = 0;
	while(!feof($data) || $colected != ""){
		$b = fread($data,10240000);	
		$colected .= $b;
		if(has($colected,"@") && $fname == ""){
			$bname = explode("@",$colected)[0];
			$fname = hex2bin($bname);
			$colected = str_replace("$bname@","",$colected);
			
		}
		if(has($colected,"#")){
			$tmp = explode("#",$colected)[0];
			if($tmp != "" && !has($tmp,"#")){
				if($i == $index){
					file_put_contents($fname,hex2bin($tmp),FILE_APPEND);
					fclose($data);
					break;
				}
				$i++;
				$fname = "";
				$colected = str_replace("$tmp#","",$colected);
			}
		}
		if($fname != "" && $colected != ""){
			while(!(strlen($colected) % 2 == 0)){
				$b = fread($data,1);
				$colected.=$b;
			}
			if($i == $index){
				file_put_contents($fname,hex2bin($colected),FILE_APPEND);
			}
			$colected = "";
		}
	}
}



function showFiles($file){
	$data = fopen($file,"rb");
	$files = [];
	$fname = "";
	$i = 0;
	$colected = "";
	while(!feof($data)){
		$char = fread($data,1);
		
		if($char != "@" && $char != "#"){
			$colected .= $char;
		}
		
		if($char == "@"){
			$fname = hex2bin($colected);
			$colected = "";
			
			$files[$i++] = $fname;
		}
		if($char == "#"){
			if($colected != ""){
				$colected = "";
			}
			$fname = "";
		}
		if($fname != "" && strlen($colected) == 10240000){
			$colected = "";
		}
	}
	print("\n");
	fclose($data);
	print_r($files);
	
}

function showFilesTest($file){
	$data = fopen($file,"rb");
	$fname = "";
	$colected = "";
	$tmp = "";
	$fnames = [];
	while(!feof($data) || $colected != ""){
		$b = fread($data,10240000);	
		$colected .= $b;
		if(has($colected,"@") && $fname == ""){
			$bname = explode("@",$colected)[0];
			$fname = hex2bin($bname);
			array_push($fnames,$fname);
			$colected = str_replace("$bname@","",$colected);
			
		}
		if(has($colected,"#")){
			$tmp = explode("#",$colected)[0];
			if($tmp != "" && !has($tmp,"#")){
				
				//file_put_contents($fname,hex2bin($tmp),FILE_APPEND);
				$fname = "";
				$colected = str_replace("$tmp#","",$colected);
			}
		}
		if($fname != "" && $colected != ""){
			while(!(strlen($colected) % 2 == 0)){
				$b = fread($data,1);
				$colected.=$b;
			}
			//file_put_contents($fname,hex2bin($colected),FILE_APPEND);
			$colected = "";
		}
	}
	//print_r($fnames);
	return $fnames;
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
	$fnames = "";
	while(true){
		$op = readline("op:");
		$options = array("add","show","extract","wf","extractAll");
		if($op == "add"){
			$toadd = readline("to add:");
			addFile($toadd,$wf);
		}else if($op == "show"){
			//showFiles($wf);
			if($fnames == ""){
				$fnames = showFilesTest($wf);
			}
			print_r($fnames);
		}else if($op == "extract"){
			$index = readline("index:");
			//extractFile($index,$wf);
			extractFileTest($wf,$index);
		}else if($op == "wf"){
			$wf = readline("work file:");
			$fnames = "";
		}else if($op == "help"){
			foreach($options as $o){
				print("$o\n");
			}
		}else if($op == "extractAll"){
			//extractFiles($wf);
			extractFilesTest($wf);
		}
	}
}

console();
