<?php

include("api.php");

$location = "America/Sao_Paulo";

$time = getTime($location);

foreach($time as $field=>$tmp){
	print("$field : $tmp\n");
}
