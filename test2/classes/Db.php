<?php
class Db {
	private static $instance;
	public $conn;
	private function __construct(){
		$this->conn = new PDO("mysql:host=localhost;dbname=users", "root", "root123");
	}
	public static function getInstance(){
		if(!self::$instance){
			self::$instance = new Db;
		}
		return self::$instance;
	}
}