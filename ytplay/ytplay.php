<?php

function play(){
	$input = readline("link:");
	exec("youtube-dl -x --audio-format mp3 $input");
	$mp3 = glob("*.mp3")[0];	
	exec("ffplay -nodisp \"$mp3\"");
	unlink($mp3);
}

play();
