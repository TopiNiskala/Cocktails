<?php
function process_form() {
	require_once __DIR__ . "/config/database.php";
	require_once __DIR__ . "/object/cocktail.php";
	$database = new Database();
	$db = $database->getConnection();

	$cocktail = new Cocktail($db);
	$cocktail->ct_name = $_POST['ct_name'];
	$cocktail->ct_glass = $_POST['ct_glass'];
	$cocktail->ct_garnish = $_POST['ct_garnish'];
	$cocktail->ct_image = $_POST['ct_image'];
	$cocktail->ct_preparation = $_POST['ct_preparation'];
	$cocktail->ct_ingredients = implode("|",$_POST['ct_ingredients']);
	if ($cocktail->create()) {
		echo '{';
			echo '"message": "Cocktail was added."';
		echo '}';
	} else {
		echo '{';
			echo '"message": "Unable to create cocktail"';
		echo '}';
	}
	header("Location: list.php");
}

function process_list() {
	require_once __DIR__ . "/config/database.php";
	require_once __DIR__ . "/object/cocktail.php";
	$database = new Database();
	$db = $database->getConnection();

	$cocktail = new Cocktail($db);
	$stmt = $cocktail->read();
	return $stmt;
}
?>
