<?php
	/* 
	 * %%%%%%%%%%%%%%%%%%%%%%%%%% *
	 * %%% CREATE TASK SCRIPT %%% *
	 * %%%%%%%%%%%%%%%%%%%%%%%%%% *
	*/

	/*** [INCLUDE] Functions ***/
	include_once $_SERVER['DOCUMENT_ROOT'].'/common/functions/task-functions.php';

	/*** [INITIALIZE FLAG + ERRORS] ***/
	$authorized_and_validated = FALSE;
	$user_id_error = $user_tasks_id_error = '';

	/*** [AUTHORIZATION & VALIDATION TEST] (Check Logged in &/or user allowed to create data here) ***/
	// USER ID //
	if (isset($_SESSION['user_id'])) {
		$user_id = trim($_SESSION['user_id']);
		$user_id = filter_var($user_id, FILTER_SANITIZE_NUMBER_INT);
		
		// USER TASKS ID //
		if (verify_user_tasks_id_exists($link, $user_id)) {
			$user_tasks_id = fetch_user_tasks_id($link, $user_id);
			$authorized_and_validated = TRUE;
		}
		// [ERROR] User Tasks ID not found (Verification Error) //
		else { $user_tasks_id_error = 'No "user_tasks_id" found. User may not be verfied..'; }
	}
	// [ERROR] User ID Not Set (Not Logged In) //
	else { $user_id_error = 'No "user_id" set.'; }

	/*** [INTITIALIZE VARIABLES] ***/
	$due_date = $due_time = $type = $name = $description = '';
	$due_date_error = $due_time_error = $type_error = $name_error = $description_error = '';

	/*** [SET DATA TO BLANK OR INVALID] Set Variables to Either URL Val. (If exists) or Blank ***/
	// Due Date // Due Date Error //
	if (isset($_GET['due_date'])) {
		$due_date = trim($_GET['due_date']);
		$due_date = filter_var($due_date, FILTER_SANITIZE_STRING);
	}

	if (isset($_GET['due_date_error'])) {
		$due_date_error = trim($_GET['due_date_error']);
		$due_date_error = filter_var($due_date_error, FILTER_SANITIZE_STRING);
	}

	// Due Time // Due Time Error //
	if (isset($_GET['due_time'])) {
		$due_time = trim($_GET['due_time']);
		$due_time = filter_var($due_time, FILTER_SANITIZE_STRING);
	}

	if (isset($_GET['due_time_error'])) {
		$due_time_error = trim($_GET['due_time_error']);
		$due_time_error = filter_var($due_time_error, FILTER_SANITIZE_STRING);
	}

	// Type // Type Error //
	if (isset($_GET['type'])) {
		$type = trim($_GET['type']);
		$type = filter_var($type, FILTER_SANITIZE_STRING);
	}

	if (isset($_GET['type_error'])) {
		$type_error = trim($_GET['type_error']);
		$type_error = filter_var($type_error, FILTER_SANITIZE_STRING);
	}

	// Name // Name Error //
	if (isset($_GET['name'])) {
		$name = trim($_GET['name']);
		$name = filter_var($name, FILTER_SANITIZE_STRING);
	}
	if (isset($_GET['name_error'])) {
		$name_error = trim($_GET['name_error']);
		$name_error = filter_var($name_error, FILTER_SANITIZE_STRING);
	}

	// Description // Description Error //
	if (isset($_GET['description'])) {
		$description = trim($_GET['description']);
		$description = filter_var($description, FILTER_SANITIZE_STRING);
	}
	if (isset($_GET['description_error'])) {
		$description_error = trim($_GET['description_error']);
		$description_error = filter_var($description_error, FILTER_SANITIZE_STRING);
	}

	/*** [FORM SUBMISSION] Proccess Form Data + Insert New Data into DB ***/
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		/* [FORM DATA VALIDATION TEST] Check the Fields */
		// Due Date //
		/* [PROCCESS DATA] Data is not empty check it now */
		if (!empty($_POST['due_date'])) {
			$due_date = trim($_POST['due_date']);
			$due_date = filter_var($due_date, FILTER_SANITIZE_STRING);
		}
		else { $due_date_error = 'Please enter a due date for this task.'; }

		// Due Time //
		/* [PROCCESS DATA] Data is not empty check it now */
		if (!empty($_POST['due_time'])) {
			$due_time = trim($_POST['due_time']);
			$due_time = filter_var($due_time, FILTER_SANITIZE_STRING);
		}
		else { $due_time_error = 'Please enter a due time for this task.'; }

		// Type //
		/* [PROCCESS DATA] Data is not empty check it now */
		if (!empty($_POST['type'])) {
			$type = trim($_POST['type']);
			$type = filter_var($type, FILTER_SANITIZE_STRING);
		}
		else { $type_error = 'Please enter a type for this task.'; }
		
		// Name //
		/* [PROCCESS DATA] Data is not empty check it now */
		if (!empty($_POST['name'])) {
			$name = trim($_POST['name']);
			$name = filter_var($name, FILTER_SANITIZE_STRING);

		}
		else { $name_error = 'Please enter a name for this task.'; }

		// Description //
		/* [PROCCESS DATA] Data is not empty check it now */
		if (!empty($_POST['description'])) {
			$description = trim($_POST['description']);
			$description = filter_var($description, FILTER_SANITIZE_STRING);
		}
		else { $description_error = 'Please enter a description for this task.'; }

		/*** [INSERT DATA] INTO DATABASE ***/
		if (
			($authorized_and_validated == TRUE) &&
			empty($due_date_error) &&
			empty($due_time_error) &&
			empty($type_error) &&
			empty($name_error) &&
			empty($description_error)
		) {
			// Set query -> Prepare the statement -> Bind variables to the prepared statement
			$sql = "INSERT INTO task (user_tasks_id, due_date, due_time, type, name, description) VALUES (?, ?, ?, ?, ?, ?)";
			$stmt = $link->prepare($sql);
			$stmt->bind_param('isssss', $user_tasks_id, $due_date, $due_time, $type, $name, $description);

			// Attempt to execute the prepared statement
			if (mysqli_stmt_execute($stmt)) {
				// Close statement -> Close connection -> redirect and exit the php script
				mysqli_stmt_close($stmt);
				mysqli_close($link);
				header("Location: /tasks");
				exit();
			}

			// Close statement just in case
			mysqli_stmt_close($stmt);
		}
		/* [ERROR -> REDIRECT] With Invalid Data */
		else {
			// Formulate the redirect URL
			$redirect_url_content =
				'&due_date=' . $due_date .
				'&due_date_error=' . $due_date_error .
				
				'&due_time=' . $due_time .
				'&due_time_error=' . $due_time_error .
				
				'&type=' . $type . 
				'&type_error=' . $type_error . 

				'&name=' . $name . 
				'&name_error=' . $name_error . 

				'&description=' . $description . 
				'&description_error=' . $description_error
			;

			// Redirect
			header("Location: /tasks/create-task/?$redirect_url_content");
			exit();

			// Close statement just in case
			mysqli_stmt_close($stmt);
		}
	}
?>