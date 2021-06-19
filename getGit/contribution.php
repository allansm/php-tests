<?php
include("git.php");

$graph = yearGraphContribution(getContribution($argv[1]));

print("\n");
print($graph);
