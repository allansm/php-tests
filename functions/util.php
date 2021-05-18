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

function isWindows(){
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		return true;
	}else{	
		return false;
	}
}

#this require notifu on windows blank in other os
function toast($message,$title,$exe){
	if(isWindows()){
		exec("start \"\" \"$exe\" /m \"\\ntime to $message\" /p \"$title\" /t none /i %SYSTEMROOT%\\system32\\imageres.dll,10 /q");
	}else{
		exec("notify-send \"$title\" \"$message\"");	
	}
}
