<?php
include("git.php");

$contribution = getContribution($argv[1]);

$graph = yearGraphContribution($contribution);

print("\n");
print($graph);


print("\n\ncontributions:\n\n");

foreach(getLast($contribution) as $last){
	print($last."\n");
}

print("\n");


print("average contribution:".round(averageYear($contribution))."\n");
$avarageLevel = avarageLevelYear($contribution);
$avarageLevel = round($avarageLevel);
$avarageLevel = str_replace("0","x",$avarageLevel);
$avarageLevel = str_replace("1","<",$avarageLevel);
$avarageLevel = str_replace("2","=",$avarageLevel);
$avarageLevel = str_replace("3",">",$avarageLevel);
$avarageLevel = str_replace("4","+",$avarageLevel);

print("avarage concept : $avarageLevel\n");
print("highest contribution:".highest($contribution)."\n");
print("total contribution:".totalContribution($contribution)."\n");
print("total contribution this year:".totalYearContribution($contribution));

print("\n");
