<?php
	// Check the status of the session if there isnt one start it
	if (session_status() === PHP_SESSION_NONE) {
		/* If not, then start a session */
		session_start();
	}

	/*
	// Check if there is a token or if the token has expired
	if (!isset($_SESSION['token']) ||  time() > $_SESSION['token_expires']) {
		// Create a token and set the time it is going to expire
		$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
		$_SESSION['token_expires'] = time() + 900;
	}
	*/

	// Database credentials. Assuming you are running MySQL server with default setting (user 'root' with no password)
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'opall');
	
	// Attempt to connect to MySQL database
	$link = new MySQLi(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
	// Catch error
	if ($link === false) { die('ERROR: Could not connect. ' . mysqli_connect_error()); }
?>
