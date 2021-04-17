<?php

function removeLineBreak($string){
	return str_replace(array("\n", "\r"), '', $string);
}

function clean(){
	echo chr(27).chr(91).'H'.chr(27).chr(91).'J';
}
