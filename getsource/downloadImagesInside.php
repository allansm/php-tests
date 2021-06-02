<?php

include("getsource.php");

toGetSource();

$page = get_remote_data($argv[1]);
$page = str_replace("'","\"",$page);
$page = str_replace("\"","\n\n",$page);

$arr = explode("/",$argv[1]);

$http = has($argv[1],"https")?"https://":"http://";

$site = $http.$arr[2];
//die($site);

$lines = explode("\n\n",$page);

foreach($lines as $line){
	if(!has($line,"<") && !has($line,">") && !has($line,",") && !has($line,"(") && !has($line,"http")){
		if(has($line,"/") || has($line,"?")){
			if(str_starts_with($line,"/")){
				print("$site$line\n");
				//download("$site$line","");
				//foreach(getImageLinks("$site$line") as $image){
					//download($image,"");	
				//}
			}else{
				print("$site/$line\n");
				//download("$site/$line","");
				//foreach(getImageLinks("$site/$line") as $image){
					//download($image,"");	
				//}
			}
		}
	}else if(str_starts_with($line,"http")){
		//download($line,"");
	}
	/*foreach(getImageLinks($link) as $image){
		download($image,"");	
	}*/
}
