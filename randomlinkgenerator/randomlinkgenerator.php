<?php

include("../functions/util.php");

function createFile($fname){
	fopen($fname, "w");
	//fclose($fname);
}

function copyLinks(){
	if(file_exists("links.txt")){
		unlink("links.txt");
	}
	$linkspath = removeLineBreak(file(".config")[0]);

	$links = file($linkspath);

	shuffle($links);
	
	createFile("links.txt");

	foreach($links as $link){
		print($link);
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
	$command = removeLineBreak(file(".config")[1])." \"".removeLineBreak($link)."\" > redirect.txt";

	//$command.=" ".removeLineBreak($link)." > redirect.txt";

	print($command."\n");

	exec($command);
	//die();
	//exec("echo test > echo.txt");
}


function run(){
	if(file_exists("links.txt")){
		//try{
			$link = consumeLine("links.txt",0);
		//}catch(exception $ex){
		//	copyLinks();
		//	$link = consumeLine("links.txt",0);
		//}
		if($link == ""){
			copyLinks();
		}else{
			$redirect = "";
			$redirect = @file("redirect.txt")[0];
			if($redirect == "")
				resolveLink($link);
		}
	}else{
		copyLinks();
	}
}
while(true)
	run();
