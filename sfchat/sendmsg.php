<?php
include("../encrypt/encrypt.php");
include("import/ttodua.php");
include("../functions/util.php");


function sender($msg){
	//while(true){
		//$msg = $argv[1];
		if($msg == "cls"){
			get_remote_data(removeLineBreak(file("url.txt")[0]).$msg);
		}else{
			//$msg = argv[1];//readline("msg:");

			$msg = file("username.txt")[0].":".$msg;
			$msg.="\n";
			$encmsg = usePattern($msg,file("key.txt")[0],"-");
			$url = removeLineBreak(file("url.txt")[0]).$encmsg;
			if(strlen($url) < 2048){
				//file_get_contents($url);
				$ht = get_remote_data($url);
			}
		}
	//}
}

sender($argv[1]);
