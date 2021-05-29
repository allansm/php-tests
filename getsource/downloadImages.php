<?php

include("import/ttodua.php");
include("../functions/util.php");
include("../functions/fileHandle.php");
include("getsourceFunctions.php");

/*
function download($url,$folder){
	$file_name = basename($url);
	
	$file_name = $folder.$file_name;

	if(file_put_contents( $file_name,file_get_contents($url))) {
		echo "File downloaded successfully\n";
	}
	else {
		echo "File downloading failed.\n";
	}
	           
}
 */

$page = get_remote_data($argv[1]);
$page = str_replace("<","\n",$page);
$page = str_replace(">","\n",$page);
$page = str_replace("'","\"",$page);

print($page."\n");

$lines = getLines($page);

/*
chdir(sys_get_temp_dir());

createFolder("getsource");
chdir("getsource");
 */
toGetSource();

foreach($lines as $line){
	if(hasPattern($line,"http;src=;.jpg") || hasPattern($line,"http;src=;.png") || hasPattern($line,"http;src=;.gif")){
		
		$url = find($line,"src=\"","\"");
		if(has($url,".jpg") || has($url,".png") || has($url,".git")){
			print("$url\n\n");
			download($url,"");
		}
	}
	if(hasPattern($line,"http;data-src=;.jpg") || hasPattern($line,"http;data-src=;.png") || hasPattern($line,"http;data-src=;.gif")){
		
		$url = find($line,"data-src=\"","\"");
		if(has($url,".jpg") || has($url,".png") || has($url,".git")){
			print("$url\n\n");
			download($url,"");
		}
	}
	if(hasPattern($line,"src=;.jpg") || hasPattern($line,"src=;.png") || hasPattern($line,"src=;.gif")){
		if(!has($line,"http")){
			$url = find($line,"src=\"","\"");
			$url = $argv[1].$url;

			print("$url\n\n");
			download($url,"");
		}
	}
}	
