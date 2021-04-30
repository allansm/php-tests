<?php

$words = $argv;

unset($words[0]);

$tosave = implode(" ",$words);
	
file_put_contents(__DIR__."/.memorized",$tosave."\n",FILE_APPEND);
