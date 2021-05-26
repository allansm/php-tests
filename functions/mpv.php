<?php

function mpv($screen,$mp4){
	if($screen == ""){
		exec("mpv --mute --ontop --no-border --geometry=300x170+1000+28 --really-quiet  ".$mp4);
	}else{
		exec("mpv --mute --no-border --geometry=$screen --really-quiet  ".$mp4);
	}
}
