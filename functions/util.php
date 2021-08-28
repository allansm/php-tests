<?php

function removeLineBreak($string){
	return str_replace(array("\n", "\r"), '', $string);
}

function clean(){
	echo chr(27).chr(91).'H'.chr(27).chr(91).'J';
}

function isOnline($file){
	$file_headers = @get_headers($file);
	if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
	    return false;
	}
	else {
	    return true;
	}	
}

function isWindows(){
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		return true;
	}else{	
		return false;
	}
}

function toast($message,$title){
	$exe = __DIR__."\\bin\\notifu";
	if(isWindows()){
		exec("@echo off");
		exec("taskkill /f /im notifu.exe 2>NUL");
		exec("start \"\" \"$exe\" /m \"\\n$message\" /p \"$title\" /t none /i %SYSTEMROOT%\\system32\\imageres.dll,10 /q");
	}else{
		exec("notify-send \"$title\" \"$message\"");	
	}
}

function has($txt,$keyword){
	if(strpos($txt, $keyword) !== false){
		return true;
     	} else{
        	return false;
	}
}

function find($str,$start,$end){
	if (preg_match("/$start(.*?)$end/", $str, $match) == 1) {
	    return $match[1];
	}
	return "";
}

function findAll($str,$start,$end){
	if (preg_match("/$start(.*?)$end/", $str, $match) == 1) {
	    return $match;
	}
	return "";
}

function getLines($txt){
	return $lines = explode("\n",$txt);
}

function hasPattern($txt,$pattern){
	$pattern = explode(";",$pattern);
	
	$size = sizeof($pattern);
	$i = 0;
	foreach($pattern as $p){
		if(has($txt,$p)){
			$i++;
		}
	}
	return ($i == $size)?true:false;
}


function download($url,$folder){
	$file_name = basename($url);
	
	$file_name = $folder.$file_name;
	
	$file_name = str_replace("=","",$file_name);
	$file_name = str_replace("?","",$file_name);

	if(file_put_contents( $file_name,file_get_contents($url))) {
		echo "File downloaded successfully\n";
	}        
}

function download2($url,$folder,$file_name){
	//$file_name = basename($url);
	
	//$file_name = $folder.$file_name;
	
	//$file_name = str_replace("=","",$file_name);
	//$file_name = str_replace("?","",$file_name);

	if(file_put_contents( $file_name,file_get_contents($url))) {
		echo "File downloaded successfully\n";
	}        
}


function remoteSize($url) {
	$headers = get_headers($url, 1);
	$filesize = $headers['Content-Length'];
	return $filesize;
}

function _do($that,$inside){
	$tmp = getcwd();
	chdir($inside);
	$ret = $that();
	chdir($tmp);

	return $ret;
}

