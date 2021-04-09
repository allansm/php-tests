<?php

$string = "my  test";

$len = strlen($string);

for($i=0;$i<$len;++$i){
	print(ord($string[$i]));
	print("\n");
}
