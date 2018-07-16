<?php
class User {
	
	public $id, $name, $email, $password;

	public function save(){
		$conn = Db::getInstance()->conn;
		$conn->exec("insert into users values(null, '{$this->name}', '{$this->email}', '{$this->password}')");
		$this->id = $conn->lastInsertId();
	}
	public static function search($field, $filter){
		$conn = Db::getInstance()->conn;
		$res = $conn->query("select name, email from users where {$field} like '%{$filter}%'");
		$res->setFetchMode(PDO::FETCH_CLASS, "User");
		$output = [];
		while($row = $res->fetch()){
			$output[] = $row;
		}
		return $output;
	}
	public static function checkUser($email, $pass){
		$conn = Db::getInstance()->conn;
		$res = $conn->query("select * from users where email = '{$email}' and password = '{$pass}' limit 1");
		$res->setFetchMode(PDO::FETCH_CLASS, "User");
		$user = $res->fetch();
		if($user){
			return $user;
		}else{
			return false;
		}
	}
	public static function checkEmail($email){
		$conn = Db::getInstance()->conn;
		$res = $conn->query("select count(*) as cnt from users where email = '{$email}'");
		$res->setFetchMode(PDO::FETCH_CLASS, "User");
		return $res->fetch();
	}
}