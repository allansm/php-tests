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

$url = $argv[1];
$screen = readline("screen size (HORIZONTALxVERTICAL or blank to miniature):");
while(true){
	$old = $url;
	$url .= rand(1,11000);
	print($url."\n");
	$page = get_remote_data($url);

	$filtered = find($page,$argv[2],$argv[3]);
		
	print_r($filtered);

	$links = array();
	
	$parsedUrl = parse_url($url);
	$root = strstr($url, $parsedUrl['path'], true);

	foreach($filtered as $f){
		array_push($links,$root.$argv[4].$f[0]);
	}
	print_r($links);
	for($i=0;$i<rand(1,100);$i++){
		shuffle($links);
	}

	$page2 = get_remote_data($links[0]);

	$filtered2 = find($page2,$argv[5],$argv[6]);

	$links2 = array();

	foreach($filtered2 as $f){
		array_push($links2,$root.$argv[7].$f[0]);
	}

	foreach($links2 as $l){
		if(array_key_exists(0,find($l,"720",""))){
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
	$url = $old;
}
