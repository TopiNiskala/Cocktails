<?php
class Ingredient {
	private $conn;
	private $table_name = "ingredient";

	public $ing_id;
	public $ing_name;
	public $ing_amount;
	public $ing_unit;
	public $ct_id;

	public function __construct($db) {
		$this->conn = $db;
	}

	function create() {
		$sql = "INSERT INTO ingredient (ing_name, ing_amount, ing_unit, ct_id) VALUES (:ing_name, :ing_amount, :ing_unit, :ct_id);";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':ing_name', $this->ing_name);
		$stmt->bindValue(':ing_amount', $this->ing_amount);
		$stmt->bindValue(':ing_unit', $this->ing_unit);
		$stmt->bindValue(':ct_id', $this->ct_id);
		if ($stmt->execute()) {
			return true;
		}
		return false;
	}

	function read() {
		$sql = "SELECT * FROM ingredient ORDER BY ing_name DESC";
		$stmt = $this->conn->prepare($sql);
		if ($stmt->execute()) {
			return true;
		}
		return false;
	}

	function update() {
		$sql = "UPDATE ingredient SET ing_name=:ing_name, ing_amount=:ing_amount, ing_unit=:ing_unit, ct_id=:ct_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':ing_name', $this->ing_name);
		$stmt->bindValue(':ing_amount', $this->ing_amount);
		$stmt->bindValue(':ing_unit', $this->ing_unit);
		$stmt->bindValue(':ct_id', $this->ct_id);
		if ($stmt->execute()) {
			return true;
		}
		return false;
	}

	function delete() {
		$sql = "DELETE FROM ingredient WHERE ing_id=:ing_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':ing_id', $this->ing_id);
		if ($stmt->execute()) {
			return true;
		}
		return false;
	}
}
