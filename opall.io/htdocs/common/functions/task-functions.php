<?php
	/* 
	 * ==============================================
	 *   TASKS
	 * ==============================================
	 */
	// [EXISTANCE CHECK] Check if the "user_tasks_id" exits //
	function verify_user_tasks_id_exists($link, $user_id) {
		// Set query -> Prepare the statement -> Bind variables to the prepared statement
		$sql = "SELECT user_tasks_id FROM user_tasks WHERE user_id=? LIMIT 1";
		$stmt = $link->prepare($sql);
		$stmt->bind_param('i', $user_id);

		// Execute the prepared statement -> Store result -> Store number of rows from query
		$stmt->execute();
		$stmt->store_result();
		$row_count = $stmt->num_rows();
		
		// Set Variable to return
		if ($row_count == 1) { $status = TRUE; } else { $status = FALSE; }

		// Close connection
		$stmt->close();

		// Return the Status
		return $status;
	}

	// [FETCH DATA] Check if the "user_tasks_id" exits //
	function fetch_user_tasks_id($link, $user_id) {
		// Set query -> Prepare the statement -> Bind variables to the prepared statement
		$sql = "SELECT user_tasks_id FROM user_tasks WHERE user_id=?";
		$stmt = $link->prepare($sql);
		$stmt->bind_param('i', $user_id);

		// Execute the prepared statement -> Store result -> Store number of rows from query -> Bind result variables -> Fetch the associated variables
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($user_tasks_id); 
		$stmt->fetch();

		// Close connection
		$stmt->close();

		// Return the ID
		return $user_tasks_id;
	}

	// Check to see if the task exits //
	function verify_task_exists($link, $task_id) {
		// Set query -> Prepare the statement -> Bind variables to the prepared statement
		$sql = "SELECT task_id FROM task WHERE task_id=? LIMIT 1";
		$stmt = $link->prepare($sql);
		$stmt->bind_param('i', $task_id);

		// Execute the prepared statement -> Store result -> Store number of rows from query
		$stmt->execute();
		$stmt->store_result();
		$row_count = $stmt->num_rows();

		// Set Variable to return
		if ($row_count == 1) { $status = TRUE; } else { $status = FALSE; }

		// Close connection
		$stmt->close();

		// Return the Status
		return $status;
	}

	// Check to see if the task belongs to that owner //
	function verify_task_ownership($link, $task_id, $user_tasks_id) {
		// Set query -> Prepare the statement -> Bind variables to the prepared statement
		$sql = "SELECT task_id FROM task WHERE task_id=? AND user_tasks_id=? LIMIT 1";
		$stmt = $link->prepare($sql);
		$stmt->bind_param('ii', $task_id, $user_tasks_id);

		// Execute the prepared statement -> Store result -> Store number of rows from query
		$stmt->execute();
		$stmt->store_result();
		$row_count = $stmt->num_rows();

		// Set Variable to return
		if ($row_count == 1) { $status = TRUE; } else { $status = FALSE; }

		// Close connection
		$stmt->close();

		// Return the Status
		return $status;
	}

	// Fetch all the task data and return it to the user //
	function fetch_task_data_array($link, $task_id) {
		// Set query -> Prepare the statement -> Bind variables to the prepared statement
		$sql = "SELECT * FROM task WHERE task_id=? LIMIT 1";
		$stmt = $link->prepare($sql);
		$stmt->bind_param('i', $task_id);

		// Execute the prepared statement -> Store result -> Store number of rows from query
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result(
			$task_id,
			$user_tasks_id,
			$due_date,
			$due_time,
			$type,
			$name,
			$description,
			$created
		);
		$stmt->fetch();

		// Close connection
		$stmt->close();

		// Put data into array so that it can be returned
		$task_data = array(
			'task_id'       => $task_id,
			'user_tasks_id' => $user_tasks_id,
			'due_date'      => $due_date,
			'due_time'      => $due_time,
			'type'          => $type,
			'name'          => $name,
			'description'   => $description,
			'created'       => $created
		);
		
		return $task_data;
	}
?>