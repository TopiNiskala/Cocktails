<?php
//Class for the database connection
class Database {
	//Credentials as variables
	private $host = "localhost";
	private $db_name = "php";
	private $username = "topi";
	private $password = "Tribantura";

	public $conn;
	//Establish connection. Call this to get a connection to the database using the established credentials.
	public function getConnection() {
		$this->conn = null;
		try {
			$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->exec("set names utf8");
		} catch(PDOException $exception) {
			echo "Connection error: " . $exception->getMesssage();
		}
		return $this->conn;
	}
}
?>
