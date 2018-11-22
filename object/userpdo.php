<?php

//*********************************
//*PDO database class for Cocktail*
//*********************************

class UserPDO {

	//Variables for Cocktail and the database connection.
	private $conn;
	private $table_name = "user";
	public $usr_id;
	public $usr_name;
	public $usr_password;
	public $usr_email;

	//Constructor. Establishes only the database connection, rest of the variables are set in methods.
	public function __construct($db) {
		$this->conn = $db;
	}

	//Add a single cocktail to the database.
	function create_user() {
		$sql = "INSERT INTO user (usr_name, usr_password, usr_email) VALUES (:usr_name, :usr_password, :usr_email)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':usr_name', $this->usr_name);
		$stmt->bindValue(':usr_password', $this->usr_password);
		$stmt->bindValue(':usr_email', $this->usr_email);
		if ($stmt->execute()) {
			return true;
		}
		return false;
	}
}
?>
