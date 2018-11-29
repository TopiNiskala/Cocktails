<?php
	session_start();
	if (isset($_SESSION['usr_id'])) {
		unset($_SESSION['usr_id']);
	}
	if (isset($_SESSION['usr_name'])) {
		unset($_SESSION['usr_name']);
	}
	if (isset($_SESSION['usr_password'])) {
		unset($_SESSION['usr_password']);
	}
	if (isset($_SESSION['usr_email'])) {
		unset($_SESSION['usr_email']);
	}
	if (isset($_COOKIE['usr_id'])) {
		setcookie('usr_id','');
	}
	if (isset($_COOKIE['usr_name'])) {
		setcookie('usr_name','');
	}
	if (isset($_COOKIE['usr_password'])) {
		setcookie('usr_password','');
	}
	if (isset($_COOKIE['usr_email'])) {
		setcookie('usr_email','');
	}
	header("Location: login.php");
?>
