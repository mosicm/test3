<?php
class FormValidation {

	public $errors = [];

	public function addError($error){
		$this->errors[] = $error;
	}
	public function validateName($name){
		$name = self::clearInput($name);
		if(self::isEmpty($name)){
			$this->addError("Name field is required");
		}	
		if(!self::isAlpha($name)){
			$this->addError("Name field must contains only letters and whitespaces");
		}
		if(!self::minLength($name, 5)){
			$this->addError("Name field must contains at least 5 characters");
		}
		if(!self::maxLength($name, 60)){
			$this->addError("Name field can not contains more than 60 characters");
		}
		return $name;
	}
	public function validateEmail($email){
		$email = self::clearInput($email);
		if(self::isEmpty($email)){
			$this->addError("Email field is required");
		}
		if(!self::isEmail($email)){
			$this->addError("Email string is invalid");
		}
		if(User::checkEmail($email)->cnt > 0){
			$this->addError("This email already exists");
		}
		return $email;
	}
	public function validatePassword($password, $re_password){
		$password = self::clearInput($password);
		if(self::isEmpty($password)){
			$this->addError("Password field is required");
		}
		if(!self::minLength($password, 8)){
			$this->addError("Password field must contains at least 8 characters");
		}
		if($password != $re_password){
				$this->addError("Password confirmation is false");
		}
		
		return $password;
	}


	public static function clearInput($input){
		$input = str_replace("'", "", $input);
		$input = str_replace("<", "", $input);
		$input = str_replace(">", "", $input);
		$input = trim($input);
		return $input;
	}
	public static function isEmpty($input){
		if(empty($input)){
			return true;
		}else{
			return false;
		}
	}
	public static function isAlpha($input){
		if(preg_match("/^[a-zA-Z ]*$/",$input)){
			return true;
		}
		return false;
	}
	public static function maxLength($input, $max){
		if(strlen($input) < $max){
			return true;
		}else{
			return false;
		}
	}
	public static function minLength($input, $min){
		if(strlen($input) >= $min){
			return true;
		}else{
			return false;
		}
	}
	public static function isEmail($input){
		if(filter_var($input, FILTER_VALIDATE_EMAIL)) {
            return true;
        }else{
	        return false;	
        }
	}
}