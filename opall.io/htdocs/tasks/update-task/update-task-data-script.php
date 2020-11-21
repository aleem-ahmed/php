<?php
	/* 
	 * %%%%%%%%%%%%%%%%%%%%%%%%%% *
	 * %%% UPDATE TASK SCRIPT %%% *
	 * %%%%%%%%%%%%%%%%%%%%%%%%%% *
	 * NOTE: the reason why 2 variables are used for invalid_variable and variable
	 * is because in case at least 1 data piece is valid it doesnt get lost when
	 * the user is sent back
	 */

	/*** [INCLUDE] DEFAULT FUNCTIONS ***/
	include_once $_SERVER['DOCUMENT_ROOT'].'/common/functions/task-functions.php';

	/*** [INITIALIZE FLAG + ERRORS] ***/
	$authorized_and_validated = FALSE;
	$user_id_error = $user_tasks_id_error = $task_id_error = $task_ownership_error = '';

	/*** [AUTHORIZATION & VALIDATION TEST] ***/
	// USER ID //
	if (isset($_SESSION['user_id'])) {
		$user_id = trim($_SESSION['user_id']);
		$user_id = filter_var($user_id, FILTER_SANITIZE_NUMBER_INT);
		
		// USER TASKS ID //
		if (verify_user_tasks_id_exists($link, $user_id)) {
			$user_tasks_id = fetch_user_tasks_id($link, $user_id);

			// TASK ID //
			if (isset($_GET['task_id'])) {
				if (!empty($_GET['task_id'])) {
					$task_id = trim($_GET['task_id']);
					$task_id = filter_var($task_id, FILTER_SANITIZE_NUMBER_INT);

					// TASK EXISTANCE & OWNERSHIP //
					if (verify_task_exists($link, $task_id)) {
						if (verify_task_ownership($link, $task_id, $user_tasks_id)) {
							$authorized_and_validated = TRUE;
						}
						// [ERROR] Ownership //
						else { $task_ownership_error = 'This Task does not belong to you.'; }
					}
					// [ERROR] Task Not Existant //
					else { $task_id_error = 'Task does not exists.'; }
				}
				// [ERROR] Task ID Not Specified //
				else { $task_id_error = 'No "task_id" given.'; }
			}
			// [ERROR] Task ID Not Set //
			else { $task_id_error = 'No "task_id" set.'; }
		}
		// [ERROR] User Tasks ID not found (Verification Error) //
		else { $user_tasks_id_error = 'No "user_tasks_id" found. User may not be verfied..'; }
	}
	// [ERROR] User ID Not Set (Not Logged In) //
	else { $user_id_error = 'No "user_id" set.'; }

	/*** [SET DATA TO DB VAL OR INVALID] Set Variables to Either URL Val. (If exists) or DB Val ***/
	if ($authorized_and_validated == TRUE) {
		/* [INITIALIZE ERRORS] */
		$due_date_error = $due_time_error = $type_error = $name_error = $description_error = '';
		$due_date = $due_time = $type = $name = $description = '';

		/* [FETCH DATA] Get Data from DB */
		$fetched_task_data = fetch_task_data_array($link, $task_id);

		/* DUE DATE */
		// Due Date // Due Date Error //
		if (isset($_GET['due_date'])) {  $due_date = trim($_GET['due_date']); }
		else { $due_date = $fetched_task_data['due_date']; }

		$due_date = filter_var($due_date, FILTER_SANITIZE_STRING);

		if (isset($_GET['due_date_error'])) {
			$due_date_error = trim($_GET['due_date_error']);
			$due_date_error = filter_var($due_date_error, FILTER_SANITIZE_STRING);
		}

		/* DUE TIME */
		// Due Time // Due Time Error //
		if (isset($_GET['due_time'])) { $due_time = trim($_GET['due_time']); }
		else { $due_time = $fetched_task_data['due_time']; }

		$due_time = filter_var($due_time, FILTER_SANITIZE_STRING);

		if (isset($_GET['due_time_error'])) {
			$due_time_error = trim($_GET['due_time_error']);
			$due_time_error = filter_var($due_time_error, FILTER_SANITIZE_STRING);
		}
		
		/* TYPE */
		// Type // Type Error //
		if (isset($_GET['type'])) { $type = trim($_GET['type']); }
		else { $type = $fetched_task_data['type']; }

		$type = filter_var($type, FILTER_SANITIZE_STRING);
		
		if (isset($_GET['type_error'])) {
			$type_error = trim($_GET['type_error']);
			$type_error = filter_var($type_error, FILTER_SANITIZE_STRING);
		}
		
		/* NAME */
		// Name // Name Error //
		if (isset($_GET['name'])) { $name = trim($_GET['name']); }
		else { $name = $fetched_task_data['name']; }

		$name = filter_var($name, FILTER_SANITIZE_STRING);
		
		if (isset($_GET['name_error'])) {
			$name_error = trim($_GET['name_error']);
			$name_error = filter_var($name_error, FILTER_SANITIZE_STRING);
		}

		/* DESCRIPTION */
		// Description // Description Error //
		if (isset($_GET['description'])) { $description = trim($_GET['description']); }
		else { $description = $fetched_task_data['description']; }

		$description = filter_var($description, FILTER_SANITIZE_STRING);

		if (isset($_GET['description_error'])) {
			$description_error = trim($_GET['description_error']);
			$description_error = filter_var($description_error, FILTER_SANITIZE_STRING);
		}
	}
	/* [DISPLAY NO DATA] The User Should Not View the Data **/
	else {
		// Display Nothing //
		$due_date_error = $due_time_error = $type_error = $name_error = $description_error = '';
		$due_date = $due_time = $type = $name = $description = '';
	}

	/*** [FORM SUBMISSION] Proccess Form Data + Insert New Data into DB ***/
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		/* [FORM DATA VALIDATION TEST] Check the Fields */
		// DUE DATE //
		$due_date = trim($_POST['due_date']);
		$due_date = filter_var($due_date, FILTER_SANITIZE_STRING);

		if (empty($_POST['due_date'])) { $due_date_error = 'Please enter a due date for this task.'; }
		else {
			// Check if Date is in proper format
			if (!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|1[0-9]|2[0-9]|3[0-1])$/', $due_date)) {
				$due_date_error = 'Invalid Date.';
			}
		}

		// DUE TIME //
		$due_time = trim($_POST['due_time']);
		$due_time = filter_var($due_time, FILTER_SANITIZE_STRING);

		if (empty($_POST['due_time'])) { $due_time_error = 'Please enter a due time for this task.'; }
		
		// TYPE //
		$type = trim($_POST['type']);
		$type = filter_var($type, FILTER_SANITIZE_STRING);

		if (empty($_POST['type'])) { $type_error = 'Please enter a type for this task.'; }

		// NAME //
		$name = trim($_POST['name']);
		$name = filter_var($name, FILTER_SANITIZE_STRING);

		if (empty($_POST['name'])) { $name_error = 'Please enter a name for this task.'; }

		// DESCRIPTION //
		$description = trim($_POST['description']);
		$description = filter_var($description, FILTER_SANITIZE_STRING);

		if (empty($_POST['description'])) { $description_error = 'Please enter a description for this task.'; }

		/*** [UPDATE DATA] IN DATABASE ***/
		if (
			($authorized_and_validated == TRUE) &&
			empty($due_date_error) &&
			empty($due_time_error) &&
			empty($type_error) &&
			empty($name_error) &&
			empty($description_error)
		) {
			// Set query -> Prepare the statement -> Bind variables to the prepared statement
			$sql = "UPDATE task SET due_date=?, due_time=?, type=?, name=?, description=? WHERE task_id=?";

			$stmt = $link->prepare($sql);
			$stmt->bind_param('sssssi', $due_date, $due_time, $type, $name, $description, $task_id);

			// Attempt to execute the prepared statement
			if (mysqli_stmt_execute($stmt)) {
				// Close statement -> Close connection -> redirect and exit the php script
				mysqli_stmt_close($stmt);
				mysqli_close($link);
				header("Location: /tasks/?status=task_updated");
				exit();
			}
			// Close statement just in case
			mysqli_stmt_close($stmt);
		}
		else {
			// Formulate Redirect URL //
			$redirect_url_content = 
				// TASK ID //
				'task_id=' . $task_id .

				// ID'S //
				'&task_id_error=' . $task_id_error .
				'&user_id_error=' . $user_id_error .
				'&user_tasks_id_error=' . $user_tasks_id_error .
				'&task_ownership_error=' . $task_ownership_error .

				// DUE DATE //
				'&due_date=' . $due_date .
				'&due_date_error=' . $due_date_error .

				// DUE TIME //
				'&due_time=' . $due_time .
				'&due_time_error=' . $due_time_error .

				// TYPE //
				'&type=' . $type .
				'&type_error=' . $type_error .

				// NAME //
				'&name=' . $name .
				'&name_error=' . $name_error .

				// DESCRIPTION //
				'&description=' . $description .
				'&description_error=' . $description_error	
			;

			// This redirects if something is not valid
			header("Location: /tasks/update-task/?$redirect_url_content");
		}
	}
?>