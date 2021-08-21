<?php

include("..\\functions\\util.php");
include("..\\functions\\fileHandle.php");

function old(){
	if(isOnline(readline("link"))){
		print("ok");
	}else{
		print("not ok");
	}
}
#wont work
//print(selfLocation());


toast("a","b");
