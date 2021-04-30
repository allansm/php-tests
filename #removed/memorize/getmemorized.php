<?php
include("../functions/util.php");

$lines = file(".memorized");
$nlines = array();
$i = 0;
foreach($lines as $line){
	$nlines[$i++] = removeLineBreak($line);
}

if(isset($lines)){
	echo implode(",",$nlines);
}
