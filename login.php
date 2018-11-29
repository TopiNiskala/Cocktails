<?php
require "validator.php";
require "processor.php";
require __DIR__ . "/object/user.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($form_errors = login_user()) {
		$user = new User(0, "", $_POST['usr_password'], $_POST['usr_email']);
	} else {
		ini_set('session.gc_maxlifetime',86400);
		session_start();
		$userArray = getUser($_POST['usr_email'], $_POST['usr_password']);
		$_SESSION['usr_id'] = $userArray['usr_id'];
		$_SESSION['usr_name'] = $userArray['usr_name'];
		$_SESSION['usr_password'] = $userArray['usr_password'];
		$_SESSION['usr_email'] = $userArray['usr_email'];
		if ($_POST['rememberme'] == "remember-me") {
			setcookie('usr_id',$_SESSION['usr_id'],time() + 60*60*24*7);
			setcookie('usr_name',$_SESSION['usr_name'],time() + 60*60*24*7);
			setcookie('usr_password',$_SESSION['usr_password'],time() + 60*60*24*7);
			setcookie('usr_email',$_SESSION['usr_email'],time() + 60*60*24*7);
		}
		header("Location: index.php");
	}
} else {
	$form_errors = array();
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Login">
	<meta name="author" content="Topi Niskala">
	<title>Login</title>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- Custom styles for this template -->
	<link href="./css/signin.css" rel="stylesheet">
</head>
<body class="text-center">
	<form class="form-signin" method="post">
		<h1 class="h3 mb-3 font-weight-normal">Login</h1>
		<label for="inputEmail" class="sr-only">Email</label>
		<input type="email" id="usr_email" name="usr_email" class="form-control" placeholder="Email" required>
		<label for="inputPassword" class="sr-only">Password</label>
		<input type="password" id="usr_password" name="usr_password" class="form-control" placeholder="Password" required>
		<div style="color:red">
		<?php
			if (array_key_exists("invalid_login", $form_errors)) {
				print $form_errors["invalid_login"];
			}
		?>
		</div>
		<div class="checkbox mb-3">
			<label>
				<input type="checkbox" value="remember-me" name="rememberme"> Remember me
			</label>
		</div>
		<button class="btn mb-3 btn-lg btn-success btn-block" type="submit">Login</button>
		<div class="mb-5">
			<a class="float-left" href="register.php">Create new user</a>
		</div>
		<p class="mt-5 mb-3 text-muted">&copy; Topi Niskala</p>
	</form>
</body>
</html>
