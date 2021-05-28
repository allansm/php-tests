<?php

include("import/ttodua.php");
include("../functions/util.php");


function download($url,$folder){
	/*
	$ch = curl_init($url);

	$dir = './';

	$file_name = basename($url);

	$save_file_loc = $dir . $file_name;

	$fp = fopen($save_file_loc, 'wb');

	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_HEADER, 0);

	curl_exec($ch);

	curl_close($ch);

	fclose($fp);
	 */

	$file_name = basename($url);
	
	$file_name = $folder.$file_name;

	if(file_put_contents( $file_name,file_get_contents($url))) {
		echo "File downloaded successfully\n";
	}
	else {
		echo "File downloading failed.\n";
	}
	           
}

$page = get_remote_data($argv[1]);

$lines = getLines($page);

chdir(sys_get_temp_dir());

mkdir("getsource");

chdir("getsource");

foreach($lines as $line){
	if(hasPattern($line,"http;src=;.jpg") || hasPattern($line,"http;src=;.png") || hasPattern($line,"http;src=;.gif")){
		$url = find($line,"src=\"","\""); 
		print("$url\n\n");
		download($url,"");
	}
}
