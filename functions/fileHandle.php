<?php

function createFile($fname){
	fopen($fname, "w");
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

function createFolder($folder){
	if(!file_exists($folder)){
		mkdir($folder);
	}
}

function getTemp(){
	return sys_get_temp_dir();
}

function tempWdir($folder){
	chdir(sys_get_temp_dir());
	createFolder($folder);
	chdir($folder);
}

function deleteFile($fname){
	if(file_exists($fname)){
		unlink($fname);
	}
}
