<?php
class Database {
	private $connection;
	private static $_instance;
	private $host = db_host;
	private $username = db_user;
	private $password = db_password;
	private $database = db_database;

	public static function getInstance() {
		if(!self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	
	private function __construct() {
		$this->connection = new mysqli($this->host, $this->username, 
			$this->password, $this->database);
	
		if(mysqli_connect_error()) {
			trigger_error("Невозможно подключиться к базе данных: " . mysql_connect_error(),
				 E_USER_ERROR);
		}
	}

	
	private function __clone() { }

	public function getConnection() {
		return $this->connection;
	}
	
	public function __destruct() {
		$this->connection->close();
	}
}