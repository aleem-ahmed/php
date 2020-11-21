<!-- Edit Profile Script-->
<?php
	// Use this to get the previous profile data.
	include '../get-profile-data-script.php';

	/* DEFINITION OF VARIABLES */
	// If GET data exists -> Put into variables ELSE initialize variables
	if (isset($_GET['edit_pic_url'])) { $edit_pic_url = $_GET['edit_pic_url']; } else { $edit_pic_url = $pic_url; }
	if (isset($_GET['edit_description'])) { $edit_description = $_GET['edit_description']; } else { $edit_description = $description; }

	if (isset($_GET['edit_pic_url_error'])) { $edit_pic_url_error = $_GET['edit_pic_url_error']; } else { $edit_pic_url_error = ''; }
	if (isset($_GET['edit_description_error'])) { $edit_description_error = $_GET['edit_description_error']; } else { $edit_description_error = ''; }

	$sql_error = '';

	/* FORM DATA PROCESSING */
	// If a post method was sent and nothing other than that
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Get data from the form -> santize -> store in variable
		if (empty(trim($_POST['edit_pic_url']))) {
			// Data invalid -> Still Update -> Set error
			$edit_pic_url = trim($_POST['edit_pic_url']);
			$edit_pic_url_error = 'URL Field is empty';

		} else {
			// Data valid -> empty the error -> take form data -> store
			$edit_pic_url_error = '';
			$edit_pic_url = trim($_POST['edit_pic_url']);
		}

		// Get data from the form -> santize -> store in variable
		if (empty(trim($_POST['edit_description']))) {
			// Data invalid -> Still update -> Set error
			$edit_description = trim($_POST['edit_description']);
			$edit_description_error = 'Description Field is empty';
			
		} else {
			// Data valid -> empty the error -> take form data -> store
			$edit_description_error = '';
			$edit_description = trim($_POST['edit_description']);
		}

		/* INSERTION PROCCESS */
		if (empty($edit_pic_url_error) && empty($edit_description_error)) {
			/* UPDATE THE DATA */
			// Set query -> Prepare the statement -> Bind variables to the prepared statement
			$sql = "UPDATE user SET pic_url=?, description=? WHERE user_id=?";
			$stmt = mysqli_prepare($link, $sql);
			mysqli_stmt_bind_param($stmt, 'ssi', $param_pic_url, $param_description, $param_user_id);

			//set parameters
			$param_pic_url = $edit_pic_url;
			$param_description = $edit_description;
			$param_user_id = trim($_SESSION['user_id']);

			// Attempt to execute the prepared statement
			if (mysqli_stmt_execute($stmt)) {
				// Close statement -> Close connection -> Redirect and exit the PHP script
				mysqli_stmt_close($stmt);
				mysqli_close($link);
				header("Location: /your-profile");
			exit();

			} else {
				// Set Error
				$sql_error = 'SQL Execution Error: ' . mysqli_error($link);
			}

		} else {
			// Close statement -> Close connection -> Redirect and exit the PHP script
			mysqli_stmt_close($stmt);
			mysqli_close($link);
			header("Location: ../edit-profile/?edit_pic_url=$edit_pic_url&edit_description=$edit_description&edit_pic_url_error=$edit_pic_url_error&edit_description_error=$edit_description_error");
			exit();
		}	
	}
?>