<?php

include("functions.php");
include("functions2.php");

function download($url){
	exec("wget ".$url);
}

function getPage($url){
	if(file_exists("phantom.txt")){
		unlink("phantom.txt");
	}
	$phantom = file("phantom");
	$i = array_search("\$url",$phantom);
	$phantom[$i] = str_replace("\$url", "'".$url."'", $phantom[$i]);
	
	foreach($phantom as $line){
		removeLineBreak($line);
		file_put_contents("phantom.txt", $line."\n", FILE_APPEND);
	}
	
	//exec("phantomjs phantom.txt");	
}

getPage("www.google.com");