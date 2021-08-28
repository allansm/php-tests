<?php

$lambda = function(){
	foreach(scandir(".") as $dir){
		print($dir."\n");
	}
};

function runInside($ano,$path){
	$tmp = getcwd();
	chdir($path);
	$ano();
	chdir($tmp);
}

//runInside($lambda,readline("path:"));

include("../functions/util.php");

_do($lambda,"c:\\users");
