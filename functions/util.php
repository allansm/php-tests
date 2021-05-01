<?php

function removeLineBreak($string){
	return str_replace(array("\n", "\r"), '', $string);
}

function clean(){
	echo chr(27).chr(91).'H'.chr(27).chr(91).'J';
}

function isOnline($file){
	$file_headers = @get_headers($file);
	if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
	    return false;
	}
	else {
	    return true;
	}	
}
