<?php
//include("import/ttodua.php");
include("../../php-lib/util.php");
include("../../php-lib/fileHandle.php");

function toGetSource(){
	tempWdir("getsource");
}

function check($txt,$pattern){
	foreach(explode(";",$pattern) as $tmp){
		if(has($txt,$tmp)){
			return true;
		}
	}

	return false;
}

function getValues($link){
	$html = getContents($link);
	$mod = str_replace("\n","",$html);
	$mod = str_replace("'","\"",$mod);
	$mod = str_replace("\"","\n\n",$mod);

	return explode("\n\n",$mod);
}

function getHttp($link){
	$arr = [];

	foreach(getValues($link) as $tmp){
		if(hasPattern($tmp,"http;:;//")){
			if(!check($tmp,"<;>;{;};[;];|")){
				array_push($arr,$tmp);
			}
		}
	}

	return $arr;
}

function getImageLinks($link){
	$arr = [];

	foreach(getValues($link) as $tmp){
		$tmp = strtolower($tmp);
		if(has($tmp,".jpg") || has($tmp,".png") || has($tmp,".gif")){
			if(!check($tmp,"<;>;{;};[;];|")){
				array_push($arr,$tmp);
			}
		}
	}

	return $arr;
}

function getMp4Links($link){
	$arr = [];

	foreach(getValues($link) as $tmp){
		$tmp = strtolower($tmp);
		if(has($tmp,".mp4")){
			if(!check($tmp,"<;>;{;};[;];|")){
				array_push($arr,$tmp);
			}
		}
	}

	return $arr;
}

