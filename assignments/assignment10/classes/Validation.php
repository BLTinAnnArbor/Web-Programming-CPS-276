<?php

class Validation{
	/* USED AS A FLAG CHANGES TO TRUE IF ONE OR MORE ERRORS IS FOUND */
	private $error = false;
	
	/* CHECK FORMAT IS BASCALLY A SWITCH STATEMENT THAT TAKES A VALUE AND THE NAME OF THE FUNCTION THAT NEEDS TO BE CALLED FOR THE REGULAR EXPRESSION */
	public function checkFormat($value, $regex)
	{
		switch($regex){ // regex can only be: name, address, phone, email, dob
			case "name": return $this->name($value); break;
			case "address": return $this->address($value); break;
			case "phone": return $this->phone($value); break;
			case "email": return $this->email($value); break;
			case "dob": return $this->dob($value); break;
		}
	}
	/* THE REST OF THE FUNCTIONS ARE THE INDIVIDUAL REGULAR EXPRESSION FUNCTIONS*/
	private function name($value){
		$match = preg_match('/^[a-z-\' ]{1,50}$/i', $value); // name regex
		return $this->setError($match);
	}
	private function address($value){
		$match = preg_match('/^\d+\s+[a-z]+/i', $value); // address regex
		return $this->setError($match);
	}
	private function phone($value){
		$match = preg_match('/\d{3}\.\d{3}.\d{4}$/', $value); // phone regex
		return $this->setError($match);
	}
	private function email($value){
		$match = preg_match('/^[a-z].*@[a-z].*\.[a-z]{2,}/i', $value); // email regex
		return $this->setError($match);
	}
	private function dob($value){
		$match = preg_match('/^[0-1][0-9]\/[0-3][0-9]\/[1-2][\d]{3}$/', $value); // dob regex
		return $this->setError($match);
	}
	private function setError($match){
		if(!$match){
			$this->error = true;
			return "error";
		}
		else {
			return "";
		}
	}
	/* THE SET MATCH FUNCTION ADDS THE KEY VALUE PAR OF THE STATUS TO THE ASSOCIATIVE ARRAY */
	public function checkErrors(){
		return $this->error;
	}
	
}
