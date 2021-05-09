<?php

class test{
	private $t1;
	private $t2;
	public function getT2(){
	    return $this->t2;
	}
	public function setT2($t2){
	    $this->t2 = $t2;
	}
 	
	public function getT1(){
		return $this->t1;
	}
	public function setT1($t1){
    		$this->t1 = $t1;
	}
}

$t = new test();
$t->setT1("hello");
$t->setT2("world");

echo $t->getT1() . $t->getT2();
