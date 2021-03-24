<?php

$file = scandir("f:/");

foreach($file as $f){
	print($f."\n");
}