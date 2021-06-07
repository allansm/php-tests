<?php

include("../functions/time.php");

$start = timeToMillis();

sleep(rand(1,60*20));


if(toSec(elapsed($start)) >= 60*15){
	echo "ok";
}else{
	echo toSec(elapsed($start));
	readline("this is a security lock press any key");
}
