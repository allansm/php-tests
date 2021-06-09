<?php

include("git.php");
$contributions = getContribution("allansm");
$graph = txtGraph($contributions)[0]["graph"];
$last = txtGraph($contributions)[0]["last"];

print("\n");
yearGraph($contributions,2021);
print("\n$last\n");

