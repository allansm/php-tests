<?php
function test(){
	$people["people"] = array();
	$person = array();

	$person["firstname"] = "allan";
	$person["lastname"] = "sm";

	array_push($people["people"],$person);

	$person["firstname"] = "test";
	$person["lastname"] = "test";

	array_push($people["people"],$person);

	$json = json_encode($people);

	return $json;
}

function test2($json){
	$tmp = json_decode($json);
	foreach($tmp->people as $person){
		print($person->firstname." ".$person->lastname."\n");
	}
}

$json = test();
test2($json);
