<?php

function removeLineBreak($string){
	return str_replace(array("\n", "\r"), '', $string);
}

function getFileName($filewithpath){
	$temp = explode("/",$filewithpath);
	$temp = end($temp);
	return explode(".",$temp)[0];
}

function getFileExtension($filewithpath){
	$temp = explode("/",$filewithpath);
	$temp = end($temp);
	return explode(".",$temp)[1];
}