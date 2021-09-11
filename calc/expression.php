<?php

function calc($calc){
	$exp = "return ($calc);";

	print(eval($exp));
}

calc($argv[1]);
