<?php

include("functions.php");
include("functions2.php");

function download($url){
	exec("wget ".$url);
}

function getPage($url){
	if(file_exists("phantom.txt")){
		unlink("phantom.txt");
	}
	$phantom = file("phantom");
	//$i = array_search("@url",$phantom);
	//print($i);
	$phantom[1] = str_replace("@url", "'".$url."'", $phantom[1]);
	
	foreach($phantom as $line){
		removeLineBreak($line);
		file_put_contents("phantom.txt", $line, FILE_APPEND);
	}
	
	exec("phantomjs phantom.txt");
}

function splitbt($txt,$p1,$p2){
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

function GetBetween($content,$start,$end)
{
    $r = explode($start, $content);
    if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $r;
    }
    return array();
}



$exp = implode("",file("dump.txt"));

print_r(GetBetween($exp,"href=\"","\""));

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

//getPage("http://www.google.com");