<?php
/*
include("import/ttodua.php");
include("../functions/util.php");
include("../functions/fileHandle.php");
 */
include("git.php");
//$user = $argv[1];

$contribution = getContribution($argv[1]);
/*
foreach($contribution as $c){
	$msg = $c["date"].":".$c["contribution"]."\n";
	print($msg);
}
 */

print("\n");
print(yearGraphContribution($contribution,2021));
foreach(getLast($contribution) as $last){
	print("\n".$last."\n");
}
print("\n");
//print_r(getLast($contribution));
//print_r($arr[0]["last"]);

/*
$data = get_remote_data("https://github.com/users/$user/contributions");

$lines = getLines($data);
$higher = 0;
$hdate = "";

$persist = "";

foreach($lines as $line){
	if(has($line,"data-date") && has($line,"data-count")){
		$contribuition = find($line,"data-count=\"","\"");
		$date = find($line,"data-date=\"","\"");
		
		if($contribuition > $higher){
			$hdate = $date;
			$higher = $contribuition;
		}

		if(array_key_exists(2,$argv)){
			if($argv[2] == $date){
				print("$date:$contribuition\n");
				$persist.= "$date:$contribuition\n";
			}
		}else{
			print("$date:$contribuition\n");
			$persist.= "$date:$contribuition\n";	
		}
	}
}

if(array_key_exists(2,$argv)){
	if($argv[2] == "$"){
		print("higher $hdate:$higher\n");
		$persist.= "higher $hdate:$higher\n";
	}
}

if($persist != ""){
	tempWdir("getGit");
	file_put_contents(".log","$persist\n",FILE_APPEND);
}*/
