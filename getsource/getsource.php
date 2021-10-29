<?php
include("import/ttodua.php");
include("../../php-lib/util.php");
include("../../php-lib/fileHandle.php");

function toGetSource(){
	tempWdir("getsource");
}

function getHttp($request){
	$page = get_remote_data($request);
	$page = str_replace("'","\"",$page);
	$page = str_replace("\"","\n\n",$page);

	$lines = explode("\n",$page);//getLines($page);
	
	$http = array();
	foreach($lines as $line){
		if(str_starts_with($line,"http") && !has($line,"\n")){
			array_push($http,$line);
		}
	}

	return $http;
}


function getImageLinks($request){
	$page = get_remote_data($request);
	$page = str_replace("<","\n",$page);
	$page = str_replace(">","\n",$page);
	$page = str_replace("'","\"",$page);

	$lines = explode("\n",$page);//getLines($page);	

	$images = array();
	foreach($lines as $line){
		if(hasPattern($line,"http;src=;.jpg") || hasPattern($line,"http;src=;.png") || hasPattern($line,"http;src=;.gif")){		
			$url = find($line,"src=\"","\"");
			if(has($url,".jpg") || has($url,".png") || has($url,".git")){
				
				array_push($images,$url);
			}
		}
		if(hasPattern($line,"http;data-src=;.jpg") || hasPattern($line,"http;data-src=;.png") || hasPattern($line,"http;data-src=;.gif")){
			$url = find($line,"data-src=\"","\"");
			if(has($url,".jpg") || has($url,".png") || has($url,".git")){
				
				array_push($images,$url);
			}
		}
		if(hasPattern($line,"src=;.jpg") || hasPattern($line,"src=;.png") || hasPattern($line,"src=;.gif")){
			if(!has($line,"http")){
				$url = find($line,"src=\"","\"");
				$url = $request.$url;

				array_push($images,$url);
			}
		}
	}
	return $images;

}

function getMp4Links($request){
	$page = get_remote_data($request);
	$page = str_replace("<","\n",$page);
	$page = str_replace(">","\n",$page);
	$page = str_replace("'","\"",$page);
	$page = str_replace("\"","\n\n",$page);

	$lines = explode("\n",$page);//getLines($page);	

	$mp4 = array();
	foreach($lines as $line){
		if(hasPattern($line,"http;.mp4")){
			array_push($mp4,$line);
		}
	}
	return $mp4;
}

function getValues($request){
	$page = get_remote_data($request);
	$page = str_replace("'","\"",$page);
	$page = str_replace("\"","\n\n",$page);

	$lines = explode("\n",$page);//getLines($page);
	
	$values = array();
	foreach($lines as $line){
		if(!has($line,"<") && !has($line,">") && !has($line,"=")){
			array_push($values,$line);
		}
	}
	return $values;
}
