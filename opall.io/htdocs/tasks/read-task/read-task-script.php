<?php
	/* 
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% *
	 * %%% READ SINGLE TASK SCRIPT %%% *
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% *
	 */

	/*** [INCLUDE] Functions ***/
	include_once $_SERVER['DOCUMENT_ROOT'].'/common/functions/task-functions.php';

	/*** [INITIALIZE FLAG + ERRORS] ***/
	$authorized_and_validated = FALSE;

	$user_id_error = $user_tasks_id_error = $task_id_error = $task_ownership_error = '';

	/*** [AUTHORIZATION + VALIDATION] Check if Data Exists & Meets All Credentials ***/
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
		else { $user_tasks_id_error = 'No "user_tasks_id" found. User may not be verfied..';}
	}
	// [ERROR] User ID Not Set (Not Logged In) //
	else { $user_id_error = 'No "user_id" set.'; }

	/*** [FETCH DATA -> DISPLAY DATA] ALL VARIABLES ***/
	if ($authorized_and_validated == TRUE) {
		// Get the task data from the DB
		$task_data = fetch_task_data_array($link, $task_id);

		// Set variables as the data retrieved from the DB
		$task_id = $task_data['task_id'];
		$user_tasks_id = $task_data['user_tasks_id'];
		$due_date = $task_data['due_date'];
		$due_time = $task_data['due_time'];
		$type = $task_data['type'];
		$name = $task_data['name'];
		$description = $task_data['description'];
		$created = $task_data['created'];
	}
	else {
		$due_date = $due_time = $type = $name = $description = $created = '';
		$user_id_error = $user_tasks_id_error = $task_id_error = $task_ownership_error = '';
	}
?>