<!-- [DELETE] Task Page/Script -->
<?php
	/*** [INCLUDE] DEFAULT FUNCTIONS ***/
	include_once $_SERVER['DOCUMENT_ROOT'].'/common/functions/task-functions.php';
	
	/*** [INITIALIZE] VARIABLES (Ordered by SQL table) ***/
	// ID Errors, Task Data, & Task Data Errors //
	$delete_answer = '';
	$user_id_error = '';
	$user_tasks_id_error = '';
	$task_id_error = '';
	$task_ownership_error = '';

	/*** [EXISTANCE STATUS + OWNERSHIP + FETCH DATA] USER ID, USER_TASKS_ID, & TASK_ID ***/
	// USER ID //
	if (isset($_SESSION['user_id'])) {
		$user_id = trim($_SESSION['user_id']);
		
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
							$everything_is_ok = TRUE;
						}
						else {
							// [ERROR] Ownership //
							$task_ownership_error = 'This Task does not belong to you.';
						}
					}
					else {
						// [ERROR] Task Not Existant //
						$task_id_error = 'Task does not exists.';
					}
				}
				else {
					// [ERROR] Task ID Not Specified //
					$task_id_error = 'No "task_id" given.';
				}
			}
			else {
				// [ERROR] Task ID Not Set //
				$task_id_error = 'No "task_id" set.';
			}
		}
		else {
			// [ERROR] User Tasks ID not found (Verification Error) //
			$user_tasks_id_error = 'No "user_tasks_id" found. User may not be verfied..';
		}
	}
	else {
		// [ERROR] User ID Not Set (Not Logged In) //
		$user_id_error = 'No "user_id" set.';
	}

	/*** [PROCCESS FORM DATA] AFTER SUBMISSION ***/
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$deletion_decision = trim($_POST['deletion-decision']);

		if ($deletion_decision == 'yes') {
			/*** [UPDATE DATA] IN DATABASE ***/
			if ($everything_is_ok == TRUE) {
				// Set query -> Prepare the statement -> Bind variables to the prepared statement
				$sql = "DELETE FROM task WHERE task_id=?";

				$stmt = $link->prepare($sql);
				$stmt->bind_param('i', $task_id);

				// Attempt to execute the prepared statement
				if (mysqli_stmt_execute($stmt)) {
					// Close statement -> Close connection -> 
					mysqli_stmt_close($stmt);
					mysqli_close($link);

					// Formulate URL data -> Redirect -> Exit the php script
					$redirect_url_content = 
						'status=deletion_success' .
						'&task_id=' . $task_id .
						'&user_id_error' . $user_id_error . 
						'&user_tasks_id_error' . $user_tasks_id_error . 
						'&task_id_error' . $task_id_error .
						'&task_ownership_error' . $task_ownership_error
					;

					header("Location: /tasks/read-task/delete-task/deletion-status/?$redirect_url_content");
					exit();
				}
				// Close statement just in case
				mysqli_stmt_close($stmt);
			}
			else {
				// Formulate URL data
				$redirect_url_content =
					'status=deletion_error' .
					'&task_id=' . $task_id .
					'&user_id_error=' . $user_id_error . 
					'&user_tasks_id_error=' . $user_tasks_id_error . 
					'&task_id_error=' . $task_id_error .
					'&task_ownership_error=' . $task_ownership_error
				;

				// This redirects if something is not valid
				header("Location: /tasks/read-task/delete-task/deletion-status/?$redirect_url_content");
			}
		}
		else {
			// This redirects if something is not valid
			header("Location: /tasks/?message=not_deleting_task");
		}
	}
?>