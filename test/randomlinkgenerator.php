<?php


function generate(){
	$linkspath = file(".config")[0];

	$links = file($linkspath);

	foreach($links as $link){
		file_put_contents("links.txt",$link,FILE_APPEND);
	}
}

function consumeLine($fname,$index){
	$file = file($fname);

	$ret = $file[$index];
	
	unset($file[$index]);
	
	unlink($fname);

	foreach($file as $line){
		file_put_contents($fname,$line,FILE_APPEND);
	}
	
	return $ret;
}
