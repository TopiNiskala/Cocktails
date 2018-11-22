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
			<h1 class="h3 mb-3 font-weight-normal">Create a new user account:</h1>
			<label for="inputName" class="sr-only">Name</label>
			<input type="text" id="name" name="name" class="form-control" placeholder="Username" required>
			<label for="inputEmail" class="sr-only">Email</label>
			<input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
			<label for="inputPassword" class="sr-only">Salasana</label>
			<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
			<button class="btn mb-3 btn-lg btn-success btn-block" type="submit">Create account</button>
			<div class="mb-5">
				<a class="float-left" href="login.php">Login</a>
			</div>
			<p class="mt-5 mb-3 text-muted">&copy; Topi Niskala</p>
		</form>
	</body>
</html>
