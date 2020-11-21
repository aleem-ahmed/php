<?php
	// Initialize the session
	session_start();
	
	// Unset all of the session variables
	$_SESSION = array();
	
	// Destroy the session.
	session_destroy();
	
	// Redirect to login page
	header('location: /login');
	exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	
</body>
</html>