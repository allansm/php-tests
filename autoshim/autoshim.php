<?php
$path = file(".path");
$path2 = readline("Path: ");
$programname = explode(".",end(explode("/",$path2)))[0];
//print($programname);
//remove \n
$path[0] = str_replace(array("\n", "\r"), '', $path[0]);
$path[1] = str_replace(array("\n", "\r"), '', $path[1]);

print($path[0]."program.exe"."\n");

copy($path[0]."program.exe",$path[1].$programname.".exe");
//copy($path[0]."program.ps1",$path[1].$programname.".ps1");

file_put_contents($path[1].$programname.".shim", "path = ".$path2);
