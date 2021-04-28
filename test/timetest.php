<?php

include("../functions/time.php");
include("../functions/util.php");

$start = timeToMillis();

while(true){
	print(toSec(elapsed($start))."\n");
	clean();
}

