<?php
function validate_form() {
	$errors = array();
	$glass = array("Cocktail Glass","Old Fashioned Glass","Highball Glass","Collins Glass","Shot Glass","Champagne Flute","Irish Coffee Mug","Wine Glass","Margarita Glass","Copper Mug","Poco","Hurricane Glass");
	$unit = array("cl","Dashes","Splashes","Whole","Drops","Teaspoons");

	//Check if ct_name is valid through Regex
	if (!preg_match('[^[A-Za-z0-9 .\'?!]{3,35}$]', $_POST['ct_name'])) {
		$errors["name_not_valid"] = "Cocktail name must be between 3 and 35 length and cannot contain special character apart from (.'?!).";
	}

	//Check if ct_glass is a valid choice
	if (! in_array($_POST['ct_glass'], $glass)) {
		$errors["glass_not_on_list"] = "Glass must be chosen from the given list.";
	}

	//Check if ct_garnish is valid through Regex
	if ($_POST['ct_garnish'] != "" || $_POST['ct_garnish'] != NULL) {
		if (!preg_match('[^[A-Za-z0-9 .\'?!]{3,35}$]', $_POST['ct_garnish'])) {
			$errors["garnish_not_valid"] = "Cocktail garnish must be between 3 and 35 length and cannot contain special characters apart from (.'?!)";
		}
	}

	//Check if URL is a correct image url
	if ($_POST['ct_image'] != "" || $_POST['ct_image'] != NULL) {
		if ($image = @getimagesize($_POST['ct_image'])) {
			$image = getimagesize($_POST['ct_image']);
			if ($image == 0 || $image == NULL) {
				$errors["image_not_valid"] = "Image must be an URL to a valid image.";
			}
		} else {
			$errors["image_not_valid"] = "Image must be an URL to a valid image.";
		}
	}

	//Check if ct_instruction is valid through Regex ^[A-Za-z0-9 .,'"?!]{3,255}$
	if (!preg_match('[^[A-Za-z0-9 .,\'"?!\s]{3,255}$]', $_POST['ct_preparation'])) {
		$errors["preparation_not_valid"] = "Preparation instructions must be between 3 and 255 length and cannot contain special character apart from (.,'\"?!)";
	}

	//Check if ingredient array is correct
	if (isset($_POST['ct_ingredients'])) {
		$ingredients = $_POST['ct_ingredients'];
		foreach ($ingredients as $ingredient) {
			$ing_array = explode(",", $ingredient);
			$osa_1 = $ing_array[0];
			$osa_2 = $ing_array[1];
			$osa_3 = $ing_array[2];
			if (!preg_match('[^[A-Za-z0-9 .\'?!]{3,35}$]', $osa_1)) {
				$errors["ingredient_name_not_valid"] = "Ingredient names must be between 3 and 35 length and cannot contain special characters apart from (.'?!)";
			}
			$amount_ok = filter_var($osa_2, FILTER_VALIDATE_INT);
			if ($amount_ok > 100 || $amount_ok < 0) {
				$errors["ingredient_amount_not_valid"] = "Ingredient amount must be a valid number between 0 and 100";
			}
			if (! in_array($osa_3, $unit)) {
				$errors["ingredient_unit_not_valid"] = "Ingredient unit must be chosen from the list of choices.";
			}
		}
	} else {
		$errors["no_ingredients"] = "Cocktail must contain ingredients.";
	}
	return $errors;
}

function validate_new_user() {
	require_once __DIR__ . "/config/database.php";
	require_once __DIR__ . "/object/userpdo.php";
	$database = new Database();
	$db = $database->getConnection();

	$userCheck = new UserPDO($db);
	$stmt = $userCheck->read_users();
	print_r($stmt);

	$errors = array();

	//Validate new user. Only letters and numbers, no special characters or whitepaces. 20 letters max.
	if (!preg_match('[^[A-Za-z0-9]{3,20}$]', $_POST['usr_name'])) {
		$errors["usr_name_not_valid"] = "Username must be between 3 and 20 length and cannot contain special characters or spaces.";
	}

	//Validate that username and email are unique.
	foreach ($stmt as $testuser) {
		if ($_POST['usr_name'] == $testuser['usr_name']) {
			$errors["usr_name_taken"] = "Username already taken.";
		}
		if ($_POST['usr_email'] == $testuser['usr_email']) {
			$errors["usr_email_taken"] = "Email already has a user.";
		}
	}

	//Validate password. Must contain letters in both cases and numbers. More than 8 letters.
	if (strlen($_POST['usr_password']) < 8) {
		$errors["usr_password_too_short"] = "Your password must contain at least 8 Characters!";
	} else if (!preg_match("#[0-9]+#", $_POST['usr_password'])) {
		$errors["usr_password_not_valid"] = "Your password must contains at leats one number, lowercase letter and uppercase letter.";
	} else if (!preg_match("#[A-Z]+#",$_POST['usr_password'])) {
		$errors["usr_password_not_valid"] = "Your password must contains at leats one number, lowercase letter and uppercase letter.";
	} else if (!preg_match("#[a-z]+#",$_POST['usr_password'])) {
		$errors["usr_password_not_valid"] = "Your password must contains at leats one number, lowercase letter and uppercase letter.";
	}

	//Validate email. Must be valid email.
	$email = $_POST['usr_email'];
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors["usr_email_not_valid"] = "Email must be a valid email address.";
	}
	return $errors;
}
?>
