<?php
include("../encrypt/encrypt.php");
include("import/ttodua.php");
include("../functions/util.php");

function chat(){
	while(true){
		$msg = readline("msg:");
		if($msg == "#"){
			$chat = get_remote_data(removeLineBreak(file("msgloc.txt")[0]));//file_get_contents(file("msgloc.txt")[0]);
			
			$exp = explode("\n",$chat);
			foreach($exp as $line){
				$chat = useKey($line,file("key.txt")[0],"-");
				print($chat);
			}
		}else if($msg == "cls"){
			get_remote_data(removeLineBreak(file("url.txt")[0]).$msg);
		}else{
			$msg = file("username.txt")[0].":".$msg;
			$msg.="\n";
			$encmsg = usePattern($msg,file("key.txt")[0],"-");
			$url = removeLineBreak(file("url.txt")[0]).$encmsg;
			//echo $url;
			if(strlen($url) < 2048){
				//file_get_contents($url);
				$ht = get_remote_data($url);
				//echo $ht;
			}else{
				print("too long string\n");
				echo strlen($msg)." characters\n";
			}
		}
	}
}

chat();
