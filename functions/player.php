<?php
include("ff.php");
include("mpv.php");
class Player{
	private $current = "ffplay";
	private $avaible = ["ffplay","mpv"];
	
	public setPlayer($playerName){
		$this->current = $playerName;
	}
		
	public play($screen,$mp4){
		if($current == "ffplay"){
			player($screen,$mp4);
		}else if($current == "mpv"){
			mpv($screen,$mp4);
		}
	}
}


//testing

$player = new Player();

player.setPlayer("mpv");

player.play("");
