<?php
function process_form(Cocktail $cocktail) {
	require_once __DIR__ . "/config/database.php";
	require_once __DIR__ . "/object/cocktailpdo.php";
	require_once __DIR__ . "/object/cocktail.php";
	$database = new Database();
	$db = $database->getConnection();

	$cocktailpdo = new CocktailPDO($db);
	$cocktailpdo->ct_name = $cocktail->ct_name;
	$cocktailpdo->ct_glass = $cocktail->ct_glass;
	$cocktailpdo->ct_garnish = $cocktail->ct_garnish;
	$cocktailpdo->ct_image = $cocktail->ct_image;
	$cocktailpdo->ct_preparation = $cocktail->ct_preparation;
	$cocktailpdo->ct_ingredients = implode("|",$cocktail->ct_ingredients);
	if ($cocktailpdo->create()) {
		echo '{';
			echo '"message": "Cocktail was added."';
		echo '}';
	} else {
		echo '{';
			echo '"message": "Unable to create cocktail"';
		echo '}';
	}
	unset($_SESSION['cocktail']);
	header("Location: list.php");
}

function process_new_user(User $user) {
	require_once __DIR__ . "/config/database.php";
	require_once __DIR__ . "/object/userpdo.php";
	require_once __DIR__ . "/object/user.php";
	$database = new Database();
	$db = $database->getConnection();

	$userpdo = new UserPDO($db);
	$userpdo->usr_name = $user->usr_name;
	$userpdo->usr_password = $user->usr_password;
	$userpdo->usr_email = $user->usr_email;
	if ($userpdo->create_user()) {
		echo '{';
			echo '"message": "User was added."';
		echo '}';
	} else {
		echo '{';
			echo '"message": "Unable to create new user"';
		echo '}';
	}
	header("Location: login.php");
}

function process_list() {
	require_once __DIR__ . "/config/database.php";
	require_once __DIR__ . "/object/cocktailpdo.php";
	$database = new Database();
	$db = $database->getConnection();

	$cocktail = new CocktailPDO($db);
	$stmt = $cocktail->read();
	return $stmt;
}

function process_delete($del_id) {
	require_once __DIR__ . "/config/database.php";
	require_once __DIR__ . "/object/cocktailpdo.php";
	$database = new Database();
	$db = $database->getConnection();
	$cocktail = new CocktailPDO($db);
	if ($cocktail->delete($del_id)) {
		echo '{';
			echo '"Message": "Cocktail was deleted."';
		echo '}';
	} else {
		echo '{';
			echo '"Message": "Unable to delete cocktail."';
		echo '}';
	}
	header("Location: list.php");
}
?>
