<?php

include("git.php");

$contributions = getContribution($argv[1]);

foreach($contributions as $contribution){
	print($contribution["date"].":".$contribution["contribution"]."\n");	
}
