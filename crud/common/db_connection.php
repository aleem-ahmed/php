<?php
	// Check the status of the session if there isnt one start it
	if (session_status() === PHP_SESSION_NONE) {
		/* If not, then start a session */
		session_start();
	}

	// Database credentials. Assuming you are running MySQL server with default setting (user 'root' with no password)
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'crud');
	
	// Attempt to connect to MySQL database
	$db_connection = new MySQLi(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
	// Catch error
	if ($db_connection === false) { die('ERROR: Could not connect. ' . mysqli_connect_error()); }
?>