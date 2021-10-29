<?php

include("getsource.php");


toGetSource();

$page = get_remote_data($argv[1]);
$page = str_replace("'","\"",$page);
$page = str_replace("\"","\n\n",$page);

$arr = explode("/",$argv[1]);

$http = has($argv[1],"https")?"https://":"http://";

$site = $http.$arr[2];

$lines = array_unique(explode("\n\n",$page));
$name = 0;
foreach($lines as $line){
	if(!has($line,"<") && !has($line,">") && !has($line,",") && !has($line,"(") && !has($line,"http") && !has($line,"==") && !has($line,"javascript") && !has($line,":")){
		if(has($line,"/") || has($line,"?")){
			if(str_starts_with($line,"/")){
				if(has($line,"amp;")){
					$line = str_replace("amp;","",$line);
				}
				print("$site$line\n");
				foreach(getImageLinks("$site$line") as $image){
					if(remoteSize($image) > 50000){
						download2($image,"",$name++.".jpg");	
					}
				}
			}else{
				if(has($line,"amp;")){
					$line = str_replace("amp;","",$line);
				}
				print("$site/$line\n");
				foreach(getImageLinks("$site/$line") as $image){
					if(remoteSize($image) > 50000){
						download2($image,"",$name++.".jpg");
					}
				}
			}
		}
	}else if(str_starts_with($line,"http")){
		if(has($line,".png") || has($line,".jpg") || has($line,".gif")){
			if(has($line,"amp;")){
				$line = str_replace("amp;","",$line);
			}
			if(remoteSize($line) > 50000){
				download2($line,"",$name++.".jpg");
			}
		}
	}
}
