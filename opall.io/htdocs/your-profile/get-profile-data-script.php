<!-- Get Profile Data Script -->
<?php
/* Tasks of Script
 * 1) get the description from the database
 * 2) Get the profile URL
 */

	/* Initialize Variables */
	// Set the variables
	$user_id= $_SESSION['user_id'];
	$username = $_SESSION['username'];
	$pic_url ='';
	$description = '';

	/* Get data from the database */
	// Set query -> Prepare the statement -> Bind variables to the prepared statement
	$sql = "SELECT pic_url, description FROM user WHERE user_id=?";
	$stmt = mysqli_prepare($link, $sql);
	mysqli_stmt_bind_param($stmt, 'i', $param_user_id);
	
	// Set parameters
	$param_user_id = $user_id;
	
	// Execute the prepared statement -> Store result -> Store number of rows from query -> bind the data
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);

	mysqli_stmt_bind_result($stmt, $pic_url, $description);
	mysqli_stmt_fetch($stmt);

	// Close statement
	mysqli_stmt_close($stmt);
?>
