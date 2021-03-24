<?php
include("functions.php");
$path = file(".path");
$path2 = readline("Path: ");
$programname = getFileName($path2); //explode(".",end(explode("/",$path2)))[0];
$extension = getFileExtension($path2); //explode(".",end(explode("/",$path2)))[1];
print($programname.".".$extension."\n");
$filepath = str_replace($programname.".".$extension, "",$path2);

print($filepath);

print($programname."\n");
print($extension."\n");

$shim = removeLineBreak($path[0]); //str_replace(array("\n", "\r"), '', $path[0]);
$phpme = removeLineBreak($path[1]); //str_replace(array("\n", "\r"), '', $path[1]);
$pythonme = removeLineBreak($path[2]);
$local = removeLineBreak($path[3]);

//remove this after
//$local = "./";
print($local."\n");

$extension = strtolower($extension);

if($extension == "exe"){
	print("use shim\n");
	//die();
	
	print($shim."program.exe"."\n");

	copy($shim."program.exe",$local.$programname.".exe");

	file_put_contents($local.$programname.".shim", "path = ".$path2);
}

else if($extension == "php"){
	print("use phpme\n");
	//die();
	print($phpme."phpme.exe"."\n");

	copy($phpme."phpme.exe",$filepath.$programname.".exe");
	$tmp = $filepath.$programname.".exe";
	print($tmp."\n");
	$rpath = realpath($tmp);
	print($rpath."\n");
	$command = "mklink \"".$local.$programname."\" \"".$rpath."\"";
	print($command);
	exec($command);
	file_put_contents($local.$programname.".bat", "@echo off\n".$programname.".lnk");
}

else if($extension == "py"){
	print("use pythonme\n");
	//die();
}



die();

print($path[0]."program.exe"."\n");

copy($path[0]."program.exe",$path[1].$programname.".exe");

file_put_contents($path[1].$programname.".shim", "path = ".$path2);