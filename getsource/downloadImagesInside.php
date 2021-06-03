<?php

include("getsource.php");

function remoteSize($url) {
	$headers = get_headers($url, 1);
	$filesize = $headers['Content-Length'];
	return $filesize;
}


toGetSource();

$page = get_remote_data($argv[1]);
$page = str_replace("'","\"",$page);
$page = str_replace("\"","\n\n",$page);

$arr = explode("/",$argv[1]);

$http = has($argv[1],"https")?"https:":"http:";

$site = $http.$arr[2];

$lines = array_unique(explode("\n\n",$page));

foreach($lines as $line){
	if(!has($line,"<") && !has($line,">") && !has($line,",") && !has($line,"(") && !has($line,"http") && !has($line,"==") && !has($line,"javascript") && !has($line,":")){
		if(has($line,"/") || has($line,"?")){
			if(str_starts_with($line,"/")){
				print("$site$line\n");
				if(has($line,"amp;")){
					$line = str_replace("amp;","",$line);
				}
				foreach(getImageLinks("$site$line") as $image){
					if(remoteSize($image) > 15000){
						download($image,"");	
					}
				}
			}else{
				print("$site/$line\n");
				if(has($line,"amp;")){
					$line = str_replace("amp;","",$line);
				}
				foreach(getImageLinks("$site/$line") as $image){
					if(remoteSize($image) > 15000){
						download($image,"");
					}
				}
			}
		}
	}else if(str_starts_with($line,"http")){
		if(has($line,".png") || has($line,".jpg") || has($line,".gif")){
			if(has($line,"amp;")){
				$line = str_replace("amp;","",$line);
			}
			if(remoteSize($line) > 15000){
				download($line,"");
			}
		}
	}
}
