<?php
include("../encrypt/encrypt.php");

function chat(){
	while(true){
		$msg = readline("msg:");
		if($msg == "#"){
			$chat = file_get_contents(file("msgloc.txt")[0]);
			$exp = explode("\n",$chat);
			foreach($exp as $line){
				$chat = useKey($line,file("key.txt")[0],"-");
				print($chat);
			}
		}else{
			$msg = file("username.txt")[0].":".$msg;
			$msg.="\n";
			$encmsg = usePattern($msg,file("key.txt")[0],"-");
			$url = file("url.txt")[0].$encmsg;
			if(strlen($url) < 2048){
				file_get_contents($url);
			}else{
				print("too long string\n");
				echo strlen($msg)." characters\n";
			}
		}
	}
}

chat();
