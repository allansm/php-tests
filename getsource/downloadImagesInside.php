<?php

include("getsource.php");


toGetSource();

function getImages($site){
	print($site."\n");
	foreach(getImageLinks($site) as $image){
		download($image,"");
	}

	print("\n");
}

foreach(getHttp($argv[1]) as $link){
	getImages($link);
}
