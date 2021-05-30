<?php

function toGetSource(){
	chdir(sys_get_temp_dir());
	createFolder("getsource");
	chdir("getsource");
}

function getHttp($page){
	//$page = get_remote_data($argv[1]);
	$page = str_replace("'","\"",$page);
	$page = str_replace("\"","\n\n",$page);

	$lines = getLines($page);
	
	$http = array();
	foreach($lines as $line){
		if(str_starts_with($line,"http") && !has($line,"\n")){
			array_push($http,$line);
		}
	}

	return $http;
}


function getImageLinks(){
	$page = str_replace("<","\n",$page);
	$page = str_replace(">","\n",$page);
	$page = str_replace("'","\"",$page);

	//print($page."\n");

	$lines = getLines($page);

	//toGetSource();



	foreach($lines as $line){
		if(hasPattern($line,"http;src=;.jpg") || hasPattern($line,"http;src=;.png") || hasPattern($line,"http;src=;.gif")){		
			$url = find($line,"src=\"","\"");
			if(has($url,".jpg") || has($url,".png") || has($url,".git")){
				//print("$url\n\n");
				//download($url,"");
			}
		}
		if(hasPattern($line,"http;data-src=;.jpg") || hasPattern($line,"http;data-src=;.png") || hasPattern($line,"http;data-src=;.gif")){
			$url = find($line,"data-src=\"","\"");
			if(has($url,".jpg") || has($url,".png") || has($url,".git")){
				//print("$url\n\n");
				//download($url,"");
			}
		}
		if(hasPattern($line,"src=;.jpg") || hasPattern($line,"src=;.png") || hasPattern($line,"src=;.gif")){
			if(!has($line,"http")){
				$url = find($line,"src=\"","\"");
				$url = $argv[1].$url;

				//print("$url\n\n");
				//download($url,"");
			}
		}
	}
}
