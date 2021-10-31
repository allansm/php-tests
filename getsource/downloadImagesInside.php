<?php

include("getsource.php");

toGetSource();

function getImages($site){
	print($site."\n");
	foreach(getImageLinks($site) as $image){
		if(has($image,"http")){
			print("$image\n");


			$ext = "";
			if(has($image,".jpg")){
				$ext = ".jpg";	
			}else if(has($image,".png")){
				$ext = ".png";	
			}else if(has($image,".gif")){
				$ext = ".gif";	
			}

			@downloadOnce($image,"","",$ext);	
		}
	}

	print("\n");
}

getImages($argv[1]);

$arr = getHttp($argv[1]);
shuffle($arr);
foreach($arr as $tmp){	
	getImages($tmp);
}
