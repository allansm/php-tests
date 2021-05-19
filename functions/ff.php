<?php

function player($screen,$mp4){
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		if($screen == ""){
			exec("vlc $mp4");
			//exec("ffplay -an -x 300 -y 170 -top 28 -left 1000 -noborder -alwaysontop -framedrop -autoexit -loglevel 0 ".$mp4);
		}else{
			$size = explode("x",$screen);
			exec("ffplay -an -x ".$size[0]." -y ".$size[1]." -noborder -framedrop -autoexit -fflags nobuffer -loglevel 0 ".$mp4);	
		}
	}else{
		exec("ffplay -an -x 300 -y 170  -framedrop -autoexit -fflags nobuffer -loglevel 0 ".$mp4);
	}
}
