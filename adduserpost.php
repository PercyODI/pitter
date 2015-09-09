<?php
	session_start();
	include_once("header.php");
	include_once("functions.php");

	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	add_user_post($userid, $body);
	$_SESSION['message'] = "Your account has been created!";
	
	unset($_SESSION['message']);

	// header("Location:index.php");
?>