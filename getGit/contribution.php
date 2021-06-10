<?php

include("git.php");

$contribution = getContribution($argv[1]);


print("\n");
print(yearGraph($contribution,2021));
print("\n");
foreach(getLast($contribution) as $last){
	print($last."\n");
}

print("\n");

