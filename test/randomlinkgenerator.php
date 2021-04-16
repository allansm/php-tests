<?php

function createFile($fname){
	fopen($fname, "w");
	fclose($fname);
}

function copyLinks(){
	if(file_exists("links.txt")){
		unlink("links.txt");
	}
	$linkspath = file(".config")[0];

	$links = file($linkspath);

	createFile("links.txt");

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

function resolveLink($link){
	$command = file(".config")[1];
	$command.=" ".$link." > redirect.txt";

	exec($command);
}


function run(){
	if(file_exists("links.txt")){
		try{
			$link = consumeLine("links.txt",0);
		}catch(exception $ex){
			copyLinks();
			$link = consumeLine("links.txt",0);
		}
		if($link == ""){
			copyLinks();
		}else{
			resolveLink($link);
		}
	}else{
		copyLinks();
	}
}
while(true)
	run();
