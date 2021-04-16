<?php

function scdir($path){
	$dir = scandir($path);
	$i = 0;
	foreach($dir as $dr){
		if($dr != "." && $dr != ".." && isMp4($dr)){
			$temp[$i++] = $dr;
		}
	}
	return $temp;
}

function removeRedundant($dir,$historic){
	$localhistoric = file($historic);
	
	$temp = $dir;
	
	foreach($localhistoric as $lh){
		$i=0;
		foreach($temp as $dr){
			if(contains($lh,$dr)){
				unset($dir[$i]);
			}
			$i++;
		}
	}
	if(sizeof($dir) >0){
		return $dir;
	}else{
		writeFile($historic,"");
		return $temp;
	}
	
}

function removeNoMp4($dir){
	$temp = $dir;
	$i=0;
	
	foreach($temp as $dr){
		if(!isMp4($dr)){
			unset($dir[$i]);
		}
		$i++;
	}
	
	return $dir;
}

function addToHistoric($historic,$txt){
	file_put_contents($historic, $txt."\n", FILE_APPEND);
}

function contains($x,$y){
	if(strpos($x, $y) !== false){
		return true;
	}else{
		return false;
	}
}

function randomize($dir){
	$sec = date("s",time());
	if($sec % 2  == 1){
		rsort($dir);
		shuffle($dir);
	}

	shuffle($dir);

	if($sec % 2  == 0 && $sec % $sec == 0){
		arsort($dir);
		shuffle($dir);
	}
	return $dir;
}

function writeFile($file,$txt){
	$file = fopen($file,"w");
	fwrite($file,$txt);
	fclose($file);
}

function isMp4($url){
	if(preg_match('/mp4$/', $url)){
		return true;
	}else{
		return false;
	}
}

function copyAndRedirect($path,$copyTo){
	//copy($path, $copyTo);
	bufferedCopy($path,$copyTo,35);
	header('Location: '.$copyTo);
	die();
}

function noddos(){
	$noddos = date("i",time());
	if(file("noddos")[0] == $noddos){
		header('Location: ./loading/FINISHED.mp4');
		die();
	}else{
		writeFile("noddos",$noddos);
	}
}


function test($dir,$historic,$path,$sFileLoc,$status){
	//$local = file("local.txt");
	//$local = $local[0];
	//$loc = scdir($local);

	//$localhistoric = "localhistoric.txt";

	$rdir = removeRedundant($dir,$historic);
	sort($rdir);
	//addToHistoric($localhistoric,$rloc[0]);

	//print_r($rdir);


	//die();

	$newdir = randomize($rdir);
	$file = $newdir[0];



	//writeFile("error.txt","0");
	//writeFile("canDelete.txt","0");
	//writeFile("noddos",$noddos);


	if(isMp4($file)){
		$path = $path.$file;
		addToHistoric($historic,$file);
		//die();
		file_put_contents("status.txt", $status.$path."\n", FILE_APPEND);
		copyAndRedirect($path,$sFileLoc);
	}
}

function moveFile($file, $to){
   $path = realpath($to);
   echo exec("move \"$file\" \"$path\"");
}

function bufferedCopy($from, $to,$mb) {
    //$buffer_size = 1048576*$mb; 
	$buffer_size = 1048;
    $rbt = 0;
	
    $fileIn = fopen($from, "rb");
    $fileOut = fopen($to, "w");
	
    while(!feof($fileIn)) {
        $rbt += fwrite($fileOut, fread($fileIn, $buffer_size));
    }
	
    fclose($fileIn);
    fclose($fileOut);
	
    return $rbt;
}

function getAvaibleMemory(){
	return round(memory_get_usage()/1048576,2);
}

