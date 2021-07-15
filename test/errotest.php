<?php
/*
function get_content($url){
	if(!file_get_contents($url)){
			}

}*/
try{
	//throw new Exception("Erro bad ass");
	if(@file_get_contents("www.erroabadass") == ""){
		die("game over");
	}
	
	//throw new Exception("erro");
	//}
		
}catch(Exception $e){
	//$msg = $e->getMessage();
	//print($e->getMessage());
	
	//$ok = file_get_contents("http://www.google.com");
	//print($ok);
}
