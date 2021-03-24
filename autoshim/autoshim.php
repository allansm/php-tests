<?php
include("functions.php");
$path = file(".path");
$path2 = readline("Path: ");
$programname = getFileName($path2);
$extension = getFileExtension($path2);
print($programname.".".$extension."\n");
$filepath = str_replace($programname.".".$extension, "",$path2);

print($filepath);

print($programname."\n");
print($extension."\n");

$shim = removeLineBreak($path[0]);
$phpme = removeLineBreak($path[1]);
$pythonme = removeLineBreak($path[2]);
$local = removeLineBreak($path[3]);

print($local."\n");

$extension = strtolower($extension);

if($extension == "exe"){
	print("use shim\n");
	
	print($shim."program.exe"."\n");

	copy($shim."program.exe",$local.$programname.".exe");

	file_put_contents($local.$programname.".shim", "path = ".$path2);
}

else if($extension == "php"){
	print("use phpme\n");
	file_put_contents($local.$programname.".bat", "@echo off\n"."start /D \"".$filepath."\" php ".$programname.".php");
}

else if($extension == "py"){
	print("use pythonme\n");
	file_put_contents($local.$programname.".bat", "@echo off\n"."start /D \"".$filepath."\" python ".$programname.".py");
}

exec("pause");