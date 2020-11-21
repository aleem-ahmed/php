<?php
	/*** [CONNECTION] ***/
	if (session_status() === PHP_SESSION_NONE) { session_start(); }

	/*** [DECLARE CONSTANTS] ***/
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'opall');
	
	/*** [DECLARE CONNECTION] ***/
	$link = new MySQLi(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
	/*** [CATCH ERROR] ***/
	if ($link === false) { die('ERROR: Could not connect. ' . mysqli_connect_error()); }




	/*** [DECALRE VARIABLES] ***/
	//$data = date('l jS \of F Y h:i:s A');


	//echo $data;

	$date   = new DateTime(); //this returns the current date time
	$data = $date->format('Y-m-d H:i.s');
		
	echo $data . "<br>";


	// Create Statement / Prepare / Bind //
	$sql = "INSERT INTO test (data) VALUES (?)";
	$stmt = $link->prepare($sql);

	/*** [CATCH ERROR] ***/
	if(false === $stmt) { die('Prepare Failed: ' . htmlspecialchars($link->error)); }
	
	
	$stmt->bind_param('s', $data);

	// Attempt to execute the prepared statement
	if (mysqli_stmt_execute($stmt)) {
		// Close statement -> Close connection
		mysqli_stmt_close($stmt);
		mysqli_close($link);

		// Exit the php script
		exit();
	}

	// Close statement just in case
	mysqli_stmt_close($stmt);
?>