<?php
	/* 
	 * ==============================================
	 *   CONTACTS
	 * ==============================================
	 */
	// [EXISTANCE CHECK] Check if the "user_contacts_id" exits //
	function verify_user_contacts_id_exists($link, $user_id) {
		// Set query -> Prepare the statement -> Bind variables to the prepared statement
		$sql = "SELECT user_contacts_id FROM user_contacts WHERE user_id=? LIMIT 1";
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



	// [FETCH DATA] Check if the "user_contacts_id" exits //
	function fetch_user_contacts_id($link, $user_id) {
		// Set query -> Prepare the statement -> Bind variables to the prepared statement
		$sql = "SELECT user_contacts_id FROM user_contacts WHERE user_id=?";
		$stmt = $link->prepare($sql);
		$stmt->bind_param('i', $user_id);

		// Execute the prepared statement -> Store result -> Store number of rows from query -> Bind result variables -> Fetch the associated variables
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($user_contacts_id); 
		$stmt->fetch();

		// Close connection
		$stmt->close();

		// Return the ID
		return $user_contacts_id;
	}


	
	/* Get the IDs of those this user has added */
	function fetch_added_contact_ids($link, $user_contacts_id) {
		$stmt = $link->prepare("SELECT user_contacts_id_b FROM association WHERE user_contacts_id_a=?");

		// Bind // Execute // Store // Bind Results //
		$stmt->bind_param('i', $user_contacts_id);
		$stmt->execute(); 
		$stmt->store_result(); 
		$stmt->bind_result($user_contacts_id_b);

		// Return Array //
		return $user_contacts_id_b;
	}



	/* Get the details of the ids that are added for that person */
	function fetch_added_contact_id_b_details($link, $user_contacts_id_b) {
		$stmt = $link->prepare("SELECT user_id FROM association WHERE contact_id_b=?");

		// Bind // Execute // Store // Bind Results //
		$stmt->bind_param('i', $user_contacts_id);
		$stmt->execute(); 
		$stmt->store_result(); 
		$stmt->bind_result($user_contacts_id_b);

		// Return Array //
		return $user_contacts_id_b;
	}



	// Check to see if the contact exits //
	function verify_contact_exists($link, $contact_id) {
	/*
		// Set query -> Prepare the statement -> Bind variables to the prepared statement
		$sql = "SELECT contact_id FROM contact WHERE contact_id=? LIMIT 1";
		$stmt = $link->prepare($sql);
		$stmt->bind_param('i', $contact_id);

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
	*/
	}

	// Check to see if the contact belongs to that owner //
	function verify_contact_ownership($link, $contact_id, $user_contacts_id) {
	/*
		// Set query -> Prepare the statement -> Bind variables to the prepared statement
		$sql = "SELECT contact_id FROM contact WHERE contact_id=? AND user_contacts_id=? LIMIT 1";
		$stmt = $link->prepare($sql);
		$stmt->bind_param('ii', $contact_id, $user_contacts_id);

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
	*/
	}

	// Fetch all the contact data and return it to the user //
	function fetch_contact_data_array($link, $contact_id) {
	/*
		// Set query -> Prepare the statement -> Bind variables to the prepared statement
		$sql = "SELECT * FROM contact WHERE contact_id=? LIMIT 1";
		$stmt = $link->prepare($sql);
		$stmt->bind_param('i', $contact_id);

		// Execute the prepared statement -> Store result -> Store number of rows from query
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result(
			$contact_id,
			$user_contacts_id,
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
		$contact_data = array(
			'contact_id'       => $contact_id,
			'user_contacts_id' => $user_contacts_id,
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
		
		return $contact_data;
	*/
	}
?>