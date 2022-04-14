<?php

$zip = new ZipArchive;

if($zip->open("test.zip", ZipArchive::CREATE) === TRUE){
    $zip->addFile("test.php");  
    $zip->addFromString("hello.txt", "helloworld");
 
    $zip->close();
}

if($zip->open("test.zip") === TRUE){
	mkdir("test");
	chdir("test");
	
	$zip->extractTo(".");
	
	$zip->close();
}

chdir("..");

print(file_get_contents("test/test.php"));
print(file_get_contents("test/hello.txt"));

unlink("test/test.php");
unlink("test/hello.txt");
unlink("test.zip");
