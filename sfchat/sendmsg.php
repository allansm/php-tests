<?php
include("../encrypt/encrypt.php");
include("import/ttodua.php");
include("../functions/util.php");


function sender($msg){
	if($msg == "cls"){
		get_remote_data(removeLineBreak(file("url.txt")[0]).$msg);
	}else{
		$msg = file("username.txt")[0].":".$msg;
		$msg.="\n";
		$encmsg = usePattern($msg,file("key.txt")[0],"-");
		$url = removeLineBreak(file("url.txt")[0]).$encmsg;
		if(strlen($url) < 2048){
			$ht = get_remote_data($url);
		}
	}
}

function receiver(){
	$chat = get_remote_data(removeLineBreak(file("msgloc.txt")[0]));
	
	$exp = explode("\n",$chat);
	foreach($exp as $line){
		$chat = useKey($line,file("key.txt")[0],"-");
		print($chat);
	}

	sleep(rand(1,10));

	clean();

	receiver();
}
if($argv[1] == "showChat"){
	receiver();
	die();
}
sender($argv[1]);
