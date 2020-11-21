<?php
	// [INCLUDE SESSION -> NAME PAGE] Initialization file (Session and DB connection)
	//include_once $_SERVER['DOCUMENT_ROOT'].'/private/common/initialization.php';
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
	if ($link === false) { die('ERROR: Could not connect. ' . mysqli_connect_error()); }ndi




	/*** [DECALRE VARIABLES] ***/
	$data = time();
	$data = $data . ' test script 2';

	echo $data . '<br>';

	// Set query -> Prepare the statement -> Bind variables to the prepared statement
	$sql = "INSERT INTO test (data) VALUES (?)";
	$stmt = $link->prepare($sql);

	// [PREPARE ERROR] //
	if(false === $stmt) { die('Prepare Failed:' . htmlspecialchars($link->error)); }
	
	
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

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	
</body>
</html>