<?php
	/* 
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%% *
	 * %%% READ ALL TASKS SCRIPT %%% *
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%% *
	 */

	/*** [INCLUDE] Functions ***/
	include_once $_SERVER['DOCUMENT_ROOT'].'/common/functions/task-functions.php';



	/*** [INITIALIZE FLAG + ERRORS] ***/
	$authorized_and_validated = FALSE;
	$user_id_error = $user_tasks_id_error = '';



	/*** [AUTHORIZATION + VALIDATION] Check if Data Exists & Meets All Credentials ***/
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



	/*** [DISPLAY DATA] In Document ***/
	if ($authorized_and_validated == TRUE) {
		$table_rows = '';
		
		// Prepare // bind // execute // store // bind //
		if (!($stmt = $link->prepare("
			SELECT task_id, due_date, due_time, type, name
			FROM task
			WHERE user_tasks_id=?
			ORDER BY due_date
		"))) {
			echo "[ERROR: " . $link->errno . "] Prepare Failed: " . $link->error;
		}

		$stmt->bind_param('i', $user_tasks_id);
		$stmt->execute();
		$stmt->store_result(); 
		$stmt->bind_result($task_id, $due_date, $due_time, $type, $name); 

		while ($stmt->fetch()) { 
			$table_rows .= '
				<tr class="clickable-row" data-href="/tasks/read-task/?task_id=' . $task_id . '">
					<td>' . $type . '</td>
					<td>' . $name . '</td>
					<td>' . $due_date . '</td>
					<td>' . $due_time . '</td>
				</tr>
			';
		}
	}
	else { $table_rows = ''; }
?>