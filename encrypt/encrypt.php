<?php

function getBytes($string){
	$bytes = array();
	$len = strlen($string);

	for($i=0;$i<$len;++$i){
		$bytes[$i] = ord($string[$i]);
	}
	return $bytes;
}

function getString($bytes){
	$len = sizeOf($bytes);
	$string = "";
	for($i=0;$i<$len;++$i){
		$string.= chr($bytes[$i]);
	}
	return $string;
}

function getKeys($b1,$b2){
	$keys = array();

	$len = sizeOf($b1);
	
	for($i=0;$i<$len;++$i){
		$keys[$i] = array_search($b1[$i],$b2);
		unset($b2[$keys[$i]]);
	}
	return $keys;
}

function getLen($bytes){
	$len = sizeOf($bytes);
	
	$l = array();

	for($i=0;$i<$len;++$i){
		$l[$i] = strlen($bytes[$i]);	
	}
	return $l;
}

function getKey($keys,$len){
	$size = sizeOf($keys);
	$string = "";
	for($i=0;$i<$size;$i++){
		$string.=$len[$i]."-".$keys[$i].";";
	}
	return $string;
}

function dec($txt,$k){
	$data = explode(";",$k);
		
	$size = sizeOf($data)-1;

	$b = array();
	$keys = array();
	$len = array();
	$shuf = array();

	for($i=0;$i<$size;$i++){
		$tmp = explode("-",$data[$i]);
		$key[$i] = $tmp[1];
		$len[$i] = $tmp[0];	
	}
	for($i=0;$i<$size;$i++){
		$shuf[$i] = substr($txt,0,$len[$i]);
		$txt = substr_replace($txt, "",0, $len[$i]);	
	}
	for($i=0;$i<$size;$i++){
		$b[$i] = $shuf[$key[$i]];
	}
	
	return getString($b);
}

function enc($txt){
	$bytes = getBytes($txt);

	$shuf = $bytes;
	
	shuffle($shuf);
	
	$arr = array();
	
	$arr[0] = getKey(getKeys($bytes,$shuf),getLen($shuf));
	$arr[1] = implode($shuf);

	return $arr;	
}

function getAlphabet($pattern){
	$cfg = explode(";",$pattern);

	$alphabet = array();
	$i = 0;
	foreach($cfg as $tmp){
		$tmp2 = explode(":",$tmp);
		$alphabet[$i]["key"] = $tmp2[0];
		$alphabet[$i++]["value"] = $tmp2[1];
	}
	return $alphabet;
}

function encry($byte,$alphabet){
	$randomstuff = "";
	while($byte != 0){
		shuffle($alphabet);
		if($byte >= $alphabet[0]["value"]){
			$randomstuff.= $alphabet[0]["key"];
			$byte-= intval($alphabet[0]["value"]);
		}
	}
	return $randomstuff;
}

function decry($string,$alphabet){
	$byte = 0;
	for($i=0;$i<strlen($string);$i++){
		foreach($alphabet as $tmp){
			if($string[$i] == $tmp["key"]){
				$byte+=intval($tmp["value"]);
			}
		}
	}
	return $byte;
}

function usePattern($txt,$pattern,$delimiter){
	$alphabet = getAlphabet($pattern);

	$bytes = getBytes($txt);
	
	$temp = array();
	
	$i = 0;

	foreach($bytes as $byte){
		$temp[$i++] = encry($byte,$alphabet);	
	}

	return implode($delimiter,$temp);
}

function useKey($txt,$pattern,$delimiter){	
	$return = "";

	$alphabet = getAlphabet($pattern);
	$encry = explode($delimiter,$txt);

	foreach($encry as $enc){
		$return.=chr(decry($enc,$alphabet));
	}
	return $return;
}

/*function useKey($txt,$pattern,$delimiter){
	$alphabet = getAlphabet($pattern);

	$encry = explode($delimiter,$txt);

	$bytes = array();

	$i = 0;

	foreach($encry as $enc){
		$bytes[$i++] = decry($enc,$alphabet);
	}

	return getString($bytes);
}*/


