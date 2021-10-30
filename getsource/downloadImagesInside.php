<?php

include("getsource.php");

toGetSource();

function getImages($site){
	print($site."\n");
	foreach(getImageLinks($site) as $image){
		if(has($image,"http")){
			print("$image\n");
			downloadOnce($image);	
		}
	}

	print("\n");
}

getImages($argv[1]);
foreach(getHttp($argv[1]) as $tmp){	
	getImages($tmp);
}
