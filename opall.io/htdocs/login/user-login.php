<?php
	/* DEFINITION OF VARIABLES */
	// Take the user inputs from the URL and put into variables or if there is none than initialize variables
	$username = '';
	$password = '';

	$username_error = '';
	$password_error = '';
	
	// Processing form data when form is submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
		// Check if username is empty
		if (empty(trim($_POST['username']))) {
			$username_error = 'Please enter username.';

		} else {
			$username = trim($_POST['username']);
		}
		
		// Check if password is empty
		if (empty(trim($_POST['password']))) {
			$password_error = 'Please enter your password.';

		} else {
			$password = trim($_POST['password']);
		}
		
		// Validate credentials
		if (empty($username_error) && empty($password_error)) {
			// Set query -> Prepare the statement -> Bind variables to the prepared statement
			$sql = "SELECT user_id, username, password FROM user WHERE username=?";
			$stmt = mysqli_prepare($link, $sql);
			mysqli_stmt_bind_param($stmt, 's', $param_username);
			
			// Set parameters
			$param_username = $username;
			
			// Attempt to execute the prepared statement
			if (mysqli_stmt_execute($stmt)) {
				// Store result
				mysqli_stmt_store_result($stmt);
				
				// Check if username exists, if yes then verify password
				if (mysqli_stmt_num_rows($stmt) == 1) {                    
					// Bind result variables
					mysqli_stmt_bind_result($stmt, $user_id, $username, $hashed_password);

					// If successful attempt of fetching a result row as an associative array
					if (mysqli_stmt_fetch($stmt)) {
						// Verify that the password is correct
						if (password_verify($password, $hashed_password)) {
							// Start a session
							session_start();
							
							// Store data in session variables
							$_SESSION['loggedin'] = true;
							$_SESSION['user_id'] = $user_id;
							$_SESSION['username'] = $username;
							
							
							// Close statement -> Close connection -> Redirect and exit the PHP script
							mysqli_stmt_close($stmt);
							mysqli_close($link);
							header('location: /');
							exit();

						} else {
							// Display an error message if password is not valid
							$password_error = 'The password you entered was not valid.';
						}
					}

				} else {
					// Display an error message if username doesn't exist
					$username_error = 'No account found with that username.';
				}

			} else {
				// Could not execute the statement
				echo ('Execution Error: ' . mysqli_error($link));
			}
			
			// Close statement
			mysqli_stmt_close($stmt);
		}
	}

	// Close connection
	mysqli_close($link);
?>