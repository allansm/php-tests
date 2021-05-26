<?php
include("ff.php");
include("mpv.php");
class Player{
	private $current = "ffplay";
	private $avaible = ["ffplay","mpv"];
	
	public function setPlayer($playerName){
		$this->current = $playerName;
	}
		
	public function play($screen,$mp4){
		if($current == "ffplay"){
			player($screen,$mp4);
		}else if($current == "mpv"){
			mpv($screen,$mp4);
		}
	}
}



