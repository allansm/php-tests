<?php

include("import\\ttodua.php");

function find($html,$p1,$p2){
	$p1 = str_replace("/", "\/", $p1);
	$p2 = str_replace("/", "\/", $p2);
	
	$linkArray = array();
	if(preg_match_all("/$p1(.*?)$p2/i", $html, $matches, PREG_SET_ORDER)){
		foreach ($matches as $match) {
			array_push($linkArray, array($match[1], @$match[2]));
		}
	}
	return $linkArray;
}

$url = readline("url:");
$screen = readline("screen size (HORIZONTALxVERTICAL or blank to miniature):");
while(true){
	$page = get_remote_data($url);

	$filtered = find($page,"href=\"/video","\"");

	$links = array();

	foreach($filtered as $f){
		array_push($links,$url."/video".$f[0]);
	}
	for($i=0;$i<100;$i++){
		shuffle($links);
	}

	$page2 = get_remote_data($links[0]);

	$filtered2 = find($page2,"href=\"/dload","\"");

	$links2 = array();

	foreach($filtered2 as $f){
		array_push($links2,$url."/dload".$f[0]);
	}

	foreach($links2 as $l){
		if(array_key_exists(0,find($l,"720",""))){
			#exec("ffplay -an -x 300 -y 300 ".$l);
			if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
				if($screen == ""){
					exec("ffplay -an -x 300 -y 170 -top 28 -left 1000 -noborder -alwaysontop -framedrop -autoexit -fflags nobuffer -loglevel 0 ".$l);
				}else{
					$size = explode("x",$screen);
					exec("ffplay -an -x ".$size[0]." -y ".$size[1]." -noborder -framedrop -autoexit -fflags nobuffer -loglevel 0 ".$l);	
				}
			}else{
				exec("ffplay -an -x 300 -y 170  -framedrop -autoexit -fflags nobuffer -loglevel 0 ".$l);
			}

		}
	}
}
