<?php

include("functions.php");

$arr = file(file("file.txt")[0]);

$arr = randomize($arr);

foreach($arr as $n){
	print($n);
}