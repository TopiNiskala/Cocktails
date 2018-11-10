<?php
class Cocktail {
	private $conn;
	private $table_name = "cocktail";

	public $ct_id;
	public $ct_name;
	public $ct_glass;
	public $ct_garnish;
	public $ct_image;
	public $ct_preparation;
	public $ct_ingredients = array();

	public function __construct($db) {
		$this->conn = $db;
	}

	function create() {
		$sql = "INSERT INTO cocktail (ct_name, ct_glass, ct_garnish, ct_image, ct_preparation) VALUES (:ct_name, :ct_glass, :ct_garnish, :ct_image, :ct_preparation);";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':ct_name', $this->ct_name);
		$stmt->bindValue(':ct_glass', $this->ct_glass);
		$stmt->bindValue(':ct_garnish', $this->ct_garnish);
		$stmt->bindValue(':ct_image', $this->ct_image);
		$stmt->bindValue(':ct_preparation', $this->ct_preparation);
		if ($stmt->execute()) {
			return true;
		}
		return false;
	}

	function read() {
		$sql = "SELECT * FROM cocktail ORDER BY ct_name DESC";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return stmt;
	}

	function update() {
		$sql = "UPDATE cocktail SET ct_name=:ct_name, ct_glass=:ct_glass, ct_garnish=:ct_garnish, ct_image=:ct_image, ct_preparation=:ct_preparation";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':ct_name', $this->ct_name);
		$stmt->bindValue(':ct_glass', $this->ct_glass);
		$stmt->bindValue(':ct_garnish', $this->ct_garnish);
		$stmt->bindValue(':ct_image', $this->ct_image);
		$stmt->bindValue(':ct_preparation', $this->ct_preparation);
		if ($stmt->execute()) {
			return true;
		}
		return false;
	}

	function delete() {
		$sql = "DELETE FROM cocktail WHERE ct_id=:ct_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':ct_id', $this->ct_id);
		if ($stmt->execute()) {
			return true;
		}
		return false;
	}
}
?>
