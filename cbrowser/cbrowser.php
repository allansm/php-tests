<?php

include("browserFunctions.php");

/*include("functions.php");
include("functions2.php");

define("temp",sys_get_temp_dir()."\\phantom.txt");
define("temp2",sys_get_temp_dir()."\\dump.txt");

function download($url){
	exec("wget ".$url);
}

function getPage($url){
	if(file_exists(temp)){
		unlink(temp);
	}
	$phantom = file("phantom");
	$phantom[1] = str_replace("@url", "'".$url."'", $phantom[1]);
	$phantom[9] = str_replace("@temp", "'".str_replace("\\", "\\\\",temp2)."'", $phantom[9]);
	
	foreach($phantom as $line){
		removeLineBreak($line);
		file_put_contents(temp, $line, FILE_APPEND);
	}
	
	exec("phantomjs %temp%/phantom.txt");
}*/

/*function getPage($url){
	if(file_exists(temp)){
		unlink(temp);
	}
	$phantom = "var page = require('webpage').create();  
page.open($url, function (status) {
	if (status !== 'success') {
		console.log('Unable to access network');
	} else {
		//var p = page.evaluate(function () {
		  //  return document.getElementsByTagName('html')[0].innerHTML
		//});
	var fs = require('fs');
	var path = '".temp2."';
	//var content = 'Hello World!';
	fs.write(path, page.content, 'w');
	}
	phantom.exit();
});";
	file_put_contents(temp, $phantom, FILE_APPEND);
	exec("phantomjs %temp%/phantom.txt");
}*/

/*function splitbt($txt,$p1,$p2){
	$pattern = "/[$p1$p2]/";

	//$string = "something here ; and there, oh,that's all!";

	//echo '<pre>', print_r( , 1 ), '</pre>';
	return preg_split($pattern,$txt);
}
//$imp = implode("",file("dump.txt"));
//preg_match('/href="(.*)"/', $imp, $match);//preg_replace('/<a [^>]*href="(.+)"/', '$1-123', $imp);

//print_r($match);
function linkExtractor($html){
	$linkArray = array();
	if(preg_match_all('/<a\s+.*?href=[\"\']?([^\"\' >]*)[\"\']?[^>]*>(.*?)<\/a>/i', $html, $matches, PREG_SET_ORDER)){
		foreach ($matches as $match) {
			array_push($linkArray, array($match[1], $match[2]));
		}
	}
	return $linkArray;
}

//print_r($match);
function find($html,$p1,$p2){
	$p1 = str_replace("/", "\/", $p1);
	$p2 = str_replace("/", "\/", $p2);
	
	$linkArray = array();
	if(preg_match_all("/$p1(.*?)$p2/i", $html, $matches, PREG_SET_ORDER)){
		//try{
			foreach ($matches as $match) {
				array_push($linkArray, array($match[1], @$match[2]));
			}
		//}catch(exception $e){}
	}
	return $linkArray;
}*/

/*function GetBetween($content,$start,$end)
{
    $r = explode($start, $content);
    if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $r;
    }
    return array();
}*/





//print_r(find($exp,"<div","</div>"));

/*$dom = new DOMDocument();
$html = implode("",file("dump.txt"));
$dom->loadHTML($html);
$nodes = $dom->getElementsByTagName("a");
foreach ($nodes as $node) {
      //echo $node->nodeValue."\n";
	  print_r($node);
  }*/
//echo splitbt($imp,"href=\"","\"")[4];
/*foreach(splitbt($imp,"href=\"","\"") as $fd){
	print($fd);
}*/
$dump = "";
$found = array();
$lines = array();
$redirect = false;
while(true){
	if(!$redirect){
		$command = readline("cbrowser>");
	}else{
		getPage($url);
		$command = "storedump";
		$redirect = false;
	}
	if(strtolower($command) == "seturl"){
		$url =  readline("url:");
	}
	
	else if(strtolower($command) == "getpage"){
		getPage($url);
	}
	else if(strtolower($command) == "storedump"){
		$dump = file(temp2);
		$lines = $dump;
		while(true){
			
			$url = isset($url)?$url:temp2;
			$command = readline($url.">");
			if(strtolower($command) == "find"){
				$tmp = implode("",$dump);
				
				$p1 =  readline("start:");
				$p2 =  readline("end:");
				
				$found = find($tmp,$p1,$p2);
				$i = 0;
				foreach($found as $arr){
					$lines[$i] = $arr[0];
					print($i++.":".$arr[0]."\n\n");
				}
			}
			else if(strtolower($command) == "showlines"){
				$i = 0;
				foreach($lines as $line){
					print($i++.":".$line."\n\n");
				}
			}
			
			else if(strtolower($command) == "redirecttoline"){
				$url = $lines[readline("line:")];
				$redirect = true;
				//$command = "getpage";
				break;
			}
			else if(strtolower($command) == "addtolines"){
				$add = readline("text to add:");
				$op = readline("start or end(s/e)?");
				$tmp = array();
				if($op == "s"){
					$i = 0;
					foreach($lines as $line){
						$tmp[$i++] = $add.$line;
					}
				}else{
					$i = 0;
					foreach($lines as $line){
						$tmp[$i++] = $line.$add;
					}
				}
				$lines = $tmp;
			}
			
			else if(strtolower($command) == "exitpage"){
				break;
			}
			else if(strtolower($command) == "exit"){
				die("bye :D");
			}
		}
	}
	else if(strtolower($command) == "exit"){
		die("bye :D");
	}
}