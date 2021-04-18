<?php

$words = $argv;

unset($words[0]);

$tosave = implode(" ",$words);
	
file_put_contents(".memorized",$tosave."\n",FILE_APPEND);
