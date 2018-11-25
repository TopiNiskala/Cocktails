<?php

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
