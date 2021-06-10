<?php

include("git.php");

$contribution = getContribution($argv[1]);


print("\n");
//print(graphVertical($contribution));
print(yearGraphContribution($contribution,2021));
//print("\n");
//print(yearGraphContributionVertical($contribution,2021));

foreach(getLast($contribution) as $last){
	print("\n".$last."\n");
}
print("\n");

