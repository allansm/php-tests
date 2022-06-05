<?php

class Person{
	private $firstName;
	private $lastName;

	public function getFirstName(){
		return $this->firstName;
	}

	public function setFirstName($firstName){
		$this->firstName = $firstName;

		return $this;
	}

	public function getLastName(){
		return $this->lastName;
	}

	public function setLastName($lastName){
		$this->lastName = $lastName;

		return $this;
	}

	public function json(){
		return json_encode(get_object_vars($this));
	}
}

$person = new Person();

$person -> setFirstName("allan")
	-> setLastName("sm");

print($person->json());
