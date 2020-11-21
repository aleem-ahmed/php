<?php
	/* 
	 * %%%%%%%%%%%%%%%%%%%%%%%%%% *
	 * %%% DELETE DATA SCRIPT %%% *
	 * %%%%%%%%%%%%%%%%%%%%%%%%%% *
	 */
	
	/*** [INCLUDE] Functions ***/
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

	/*** [PROCCESS FORM DATA] AFTER SUBMISSION ***/
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$deletion_decision = trim($_POST['deletion-decision']);
		$deletion_decision = filter_var($deletion_decision, FILTER_SANITIZE_STRING);

		if ($deletion_decision == 'yes') {
			/*** [UPDATE DATA] IN DATABASE ***/
			if ($authorized_and_validated == TRUE) {
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

					header("Location: /tasks/delete-task/deletion-status/?$redirect_url_content");
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
				header("Location: /tasks/delete-task/deletion-status/?$redirect_url_content");
			}
		}
		else {
			// This redirects if something is not valid
			header("Location: /tasks/?message=not_deleting_task");
		}
	}
?>