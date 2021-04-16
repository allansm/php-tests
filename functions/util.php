<?php

function removeLineBreak($string){
	return str_replace(array("\n", "\r"), '', $string);
}

