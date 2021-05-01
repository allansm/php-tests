<?php

include("..\\functions\\util.php");

if(isOnline(readline("link"))){
	print("ok");
}else{
	print("not ok");
}
