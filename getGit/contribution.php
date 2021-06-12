<?php

include("git.php");

$contribution = getContribution($argv[1]);


print("\n");
$graph = yearGraph($contribution);
$graph = str_replace("0","x",$graph);
$graph = str_replace("1","<",$graph);
$graph = str_replace("2","=",$graph);
$graph = str_replace("3",">",$graph);
$graph = str_replace("4","+",$graph);

print("$graph\n");

print("x : none\n< : low\n= : mid\n> : high\n+ : max\n\n");

$graph = str_replace("\n"," ",$graph);

$exp = explode(" ",$graph);

$x = 0;
$c = 0;
$b = 0;
$a = 0;
$s = 0;

foreach($exp as $e){
	if($e == "x"){
		$x++;
	}
	if($e == "<"){
		$c++;
	}
	if($e == "="){
		$b++;
	}
	if($e == ">"){
		$a++;
	}
	if($e == "+"){
		$s++;
	}
}

$worked = $c+$b+$a+$s;
$total = $worked+$x;
print("x:$x\nc:$c\nb:$b\na:$a\ns:$s\nworked days:$worked\ntotal:$total\n\n");

print("contributions:\n\n");
foreach(getLast($contribution) as $last){
	print($last."\n");
}

print("\n");


print("average contribution:".round(averageYear($contribution))."\n");
print("total contribution:".totalYearContribution($contribution));

print("\n");
