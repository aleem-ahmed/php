<?php
	/* 
	 * ==============================================
	 *   EVENTS
	 * ==============================================
	 */
	// [EXISTANCE CHECK] Check if the "user_events_id" exits //
	function verify_user_events_id_exists($link, $user_id) {
		// Set query -> Prepare the statement -> Bind variables to the prepared statement
		$sql = "SELECT user_events_id FROM user_events WHERE user_id=? LIMIT 1";
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



	// [FETCH DATA] Check if the "user_events_id" exits //
	function fetch_user_events_id($link, $user_id) {
		// Set query -> Prepare the statement -> Bind variables to the prepared statement
		$sql = "SELECT user_events_id FROM user_events WHERE user_id=?";
		$stmt = $link->prepare($sql);
		$stmt->bind_param('i', $user_id);

		// Execute the prepared statement -> Store result -> Store number of rows from query -> Bind result variables -> Fetch the associated variables
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($user_events_id); 
		$stmt->fetch();

		// Close connection
		$stmt->close();

		// Return the ID
		return $user_events_id;
	}



	// Check to see if the event exits //
	function verify_event_exists($link, $event_id) {
		// Set query -> Prepare the statement -> Bind variables to the prepared statement
		$sql = "SELECT event_id FROM event WHERE event_id=? LIMIT 1";
		$stmt = $link->prepare($sql);
		$stmt->bind_param('i', $event_id);

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



	// Check to see if the event belongs to that owner //
	function verify_event_ownership($link, $event_id, $user_events_id) {
		// Set query -> Prepare the statement -> Bind variables to the prepared statement
		$sql = "SELECT event_id FROM event WHERE event_id=? AND user_events_id=? LIMIT 1";
		$stmt = $link->prepare($sql);
		$stmt->bind_param('ii', $event_id, $user_events_id);

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


	
	// Fetch all the event data and return it to the user //
	function fetch_event_data_array($link, $event_id) {
		// Set query -> Prepare the statement -> Bind variables to the prepared statement
		$sql = "SELECT * FROM event WHERE event_id=? LIMIT 1";
		$stmt = $link->prepare($sql);
		$stmt->bind_param('i', $event_id);

		// Execute the prepared statement -> Store result -> Store number of rows from query
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result(
			$event_id,
			$user_events_id,
			$days,
			$mon,
			$tue,
			$wed,
			$thu,
			$fri,
			$sat,
			$sun,
			$time_start,
			$time_end,
			$repeating,
			$period_start, 
			$period_end,
			$type,
			$name,
			$description,
			$created
		);
		$stmt->fetch();

		// Close connection
		$stmt->close();

		// Put data into array so that it can be returned
		$event_data = array(
			'event_id'       => $event_id,
			'user_events_id' => $user_events_id,
			'days'           => $days,
			'mon'            => $mon,
			'tue'            => $tue,
			'wed'            => $wed,
			'thu'            => $thu,
			'fri'            => $fri,
			'sat'            => $sat,
			'sun'            => $sun,
			'time_start'     => $time_start,
			'time_end'       => $time_end,
			'repeating'      => $repeating,
			'period_start'   => $period_start, 
			'period_end'     => $period_end,
			'type'           => $type,
			'name'           => $name,
			'description'    => $description,
			'created'        => $created
		);
		
		return $event_data;
	}
?>