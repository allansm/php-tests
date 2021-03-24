<?php

function removeLineBreak($string){
	return str_replace(array("\n", "\r"), '', $string);
}

function getFileName($filewithpath){
	if(isExplodable($filewithpath,"/")){
		$temp = explode("/",$filewithpath);
	}else{
		$temp = explode("\\",$filewithpath);
	}
	$temp = end($temp);
	return explode(".",$temp)[0];
}

function getFileExtension($filewithpath){
	if(isExplodable($filewithpath,"/")){
		$temp = explode("/",$filewithpath);
	}else{
		$temp = explode("\\",$filewithpath);
	}
	$temp = end($temp);
	return explode(".",$temp)[1];
}

function isExplodable($arr,$del){
	if(strpos($arr, $del) !== false) {
		return true;
	} else {
		return false;
	}
}