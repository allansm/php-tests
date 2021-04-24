<?php

include("functions.php");
include("functions2.php");
include("import\\ttodua.php");
	

define("temp",sys_get_temp_dir()."\\phantom.txt");
define("temp2",sys_get_temp_dir()."\\dump.txt");

function download($url){
	exec("wget ".$url);
}

function getPage($url){
	if(file_exists(temp)){
		unlink(temp);
	}
	$phantom = file("phantom");
	$phantom[1] = str_replace("@url", "'".$url."'", $phantom[1]);
	$phantom[9] = str_replace("@temp", "'".str_replace("\\", "\\\\",temp2)."'", $phantom[9]);
	
	foreach($phantom as $line){
		removeLineBreak($line);
		file_put_contents(temp, $line, FILE_APPEND);
	}
	
	exec("phantomjs %temp%/phantom.txt");
}

function getRemoteData($url){
	$page = get_remote_data($url);
		
	if(file_exists(temp2)){
		unlink(temp2);
	}

	file_put_contents(temp2,$page,FILE_APPEND);
}

function find($html,$p1,$p2){
	$p1 = str_replace("/", "\/", $p1);
	$p2 = str_replace("/", "\/", $p2);
	
	$linkArray = array();
	if(preg_match_all("/$p1(.*?)$p2/i", $html, $matches, PREG_SET_ORDER)){
		foreach ($matches as $match) {
			array_push($linkArray, array($match[1], @$match[2]));
		}
	}
	return $linkArray;
}

