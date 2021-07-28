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
		$char = fread($data,10240000);
		file_put_contents($file,bin2hex($char),FILE_APPEND);
	}
	file_put_contents($file,"#",FILE_APPEND);

	fclose($data);
}

function extractFiles($file){
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

function extractFile($file,$index){
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

function extractByName($file,$name){
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
				if($name == $fname){
					file_put_contents($fname,hex2bin($tmp),FILE_APPEND);
					fclose($data);
					break;
				}
				
				$fname = "";
				$colected = str_replace("$tmp#","",$colected);
			}
		}
		if($fname != "" && $colected != ""){
			while(!(strlen($colected) % 2 == 0)){
				$b = fread($data,1);
				$colected.=$b;
			}
			if($name == $fname){
				file_put_contents($fname,hex2bin($colected),FILE_APPEND);
			}
			$colected = "";
		}
	}
	
}


function showFiles($file){
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
				$fname = "";
				$colected = str_replace("$tmp#","",$colected);
			}
		}
		if($fname != "" && $colected != ""){
			while(!(strlen($colected) % 2 == 0)){
				$b = fread($data,1);
				$colected.=$b;
			}
			$colected = "";
		}
	}
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
