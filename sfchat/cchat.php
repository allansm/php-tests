<?php
include("../encrypt/encrypt.php");
include("import/ttodua.php");
include("../functions/util.php");


function sender($msg){
	if($msg == "cls"){
		get_remote_data(removeLineBreak(file("url.txt")[0]).$msg);
		get_remote_data(removeLineBreak(file("url.txt")[0])."");
	}else if($msg == "showOnce"){
	
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

function console($argv){
	if($argv[1] == "showChat"){
		receiver();
		die();
	}else if($argv[1] == "username"){
		$username = readline("username:");
		unlink("username.txt");
		file_put_contents("username.txt",$username);
		die();
	}else if($argv[1] == "showOnce"){
		$chat = get_remote_data(removeLineBreak(file("msgloc.txt")[0]));
		
		$exp = explode("\n",$chat);
		foreach($exp as $line){
			$chat = useKey($line,file("key.txt")[0],"-");
			print($chat."<br/>");
		}

	}else if(array_key_exists(2,$argv)){
		if($argv[2] == "cls"){
			get_remote_data(removeLineBreak(file("url.txt")[0]).$argv[2]);
			get_remote_data(removeLineBreak(file("url.txt")[0])."");

		}else{
			$msg = $argv[2];
			$msg.="\n";
			$encmsg = usePattern($msg,file("key.txt")[0],"-");
			$url = removeLineBreak(file("url.txt")[0]).$encmsg;
			if(strlen($url) < 2048){
				$ht = get_remote_data($url);
			}
		}
		die();
	}

	sender($argv[1]);
}

console($argv);
