<?php
function process_form() {
	require_once __DIR__ . "/config/database.php";
	require_once __DIR__ . "/object/cocktail.php";
	require_once __DIR__ . "/object/ingredient.php";
	$database = new Database();
	$db = $database->getConnection();

	$cocktail = new Cocktail($db);
	$cocktail->ct_name = $_POST['ct_name'];
	$cocktail->ct_glass = $_POST['ct_glass'];
	$cocktail->ct_garnish = $_POST['ct_garnish'];
	$cocktail->ct_image = $_POST['ct_image'];
	$cocktail->ct_preparation = $_POST['ct_preparation'];
	if ($cocktail->create()) {
		echo '{';
			echo '"message": "Cocktail was added."';
		echo '}';
	} else {
		echo '{';
			echo '"message": "Unable to create cocktail"';
		echo '}';
	}

	$last_id = $db->lastInsertId();

	$ingredients = $_POST['ct_ingredients'];
	foreach ($ingredients as $value) {
		$database = new Database();
		$db = $database->getConnection();
		$ingredient = new Ingredient($db);
		$ing = explode(",", $value);
		$ingredient->ing_name = $ing[0];
		$ingredient->ing_amount = $ing[1];
		$ingredient->ing_unit = $ing[2];
		$ingredient->ct_id = $last_id;
		if ($ingredient->create()) {
			echo '{';
				echo '"message": "Ingredient was added."';
			echo '}';
		} else {
			echo '{';
				echo '"message": "Unable to create ingredient"';
			echo '}';
		}
	}
	header("Location: list.php");
}
?>
