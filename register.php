<?php
require "validator.php";
require "processor.php";
require __DIR__ . "/object/user.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($form_errors = validate_new_user()) {
		$user = new User(0, $_POST['usr_name'], $_POST['usr_password'], $_POST['usr_email']);
	} else {
		$user = new User(0, $_POST['usr_name'], $_POST['usr_password'], $_POST['usr_email']);
		process_new_user($user);
	}
} else {
	$form_errors = array();
}
?>

<!DOCTYPE html>
<html lang="fi">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Registration page for a new user">
		<meta name="author" content="Topi Niskala">
		<title>New User</title>
		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<!-- Custom styles for this template -->
		<link href="./css/signin.css" rel="stylesheet">
	</head>
	<body class="text-center">
		<form class="form-signin" method="post">
			<h1 class="h3 mb-3 font-weight-normal">Create new account</h1>
			<label for="inputName" class="sr-only">Name</label>
			<input type="text" id="usr_name" name="usr_name" class="form-control" placeholder="Username" value=<?php print "'" . htmlentities($user->usr_name) . "'" ?> required>
			<div style="color:red;">
			<?php
				if (array_key_exists("usr_name_not_valid", $form_errors)) {
					print $form_errors["usr_name_not_valid"];
				} else if (array_key_exists("usr_name_taken", $form_errors)) {
					print $form_errors["usr_name_taken"];
				}
			?>
			</div>
			<label for="inputEmail" class="sr-only">Email</label>
			<input type="email" id="usr_email" name="usr_email" class="form-control" placeholder="Email" value=<?php print "'" . htmlentities($user->usr_email) . "'" ?> required>
			<div style="color:red;">
			<?php
				if (array_key_exists("usr_email_not_valid", $form_errors)) {
					print $form_errors["usr_email_not_valid"];
				} else if (array_key_exists("usr_email_taken", $form_errors)) {
					print $form_errors["usr_email_taken"];
				}
			?>
			</div>
			<label for="inputPassword" class="sr-only">Salasana</label>
			<input type="password" id="usr_password" name="usr_password" class="form-control" placeholder="Password" required>
			<div style="color:red;">
			<?php
				if (array_key_exists("usr_password_not_valid", $form_errors)) {
					print $form_errors["usr_password_not_valid"];
				} else if (array_key_exists("usr_password_too_short", $form_errors)) {
					print $form_errors["usr_password_too_short"];
				}
			?>
			</div>
			<button class="btn mb-3 btn-lg btn-success btn-block" type="submit">Create account</button>
			<div class="mb-5">
				<a class="float-left" href="login.php">Login</a>
			</div>
			<p class="mt-5 mb-3 text-muted">&copy; Topi Niskala</p>
		</form>
	</body>
</html>
