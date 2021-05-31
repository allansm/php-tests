<?php

include("getsource.php");

toGetSource();

foreach(getImageLinks($argv[1]) as $image){
	print($image."\n");
}
