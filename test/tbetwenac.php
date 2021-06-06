<?php

include("../functions/time.php");

$start = timeToMillis();

sleep(rand(1,2));
sleep(rand(1,2));
sleep(rand(1,2));
sleep(rand(1,2));
sleep(rand(1,2));


if(toSec(elapsed($start)) > 7){
	echo "ok";
}else{
	readline("this is a security lock press any key");
}
