<?php
	/* 
	 * %%%%%%%%%%%%%%%%% *
	 * %%% FUNCTIONS %%% *
	 * %%%%%%%%%%%%%%%%% *
	 */

	/*** [F] Check If data Exists ***/
	function verify_data_exists($db_connection, $data_id) {
		// Set query -> Prepare the statement -> Bind variables to the prepared statement
		$sql = "SELECT data_id FROM data_table WHERE data_id=? LIMIT 1";
		$stmt = $db_connection->prepare($sql);
		$stmt->bind_param('i', $data_id);

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

	/*** [F] Fetch All Data ***/
	function fetch_data_array($db_connection, $data_id) {
		// Set query -> Prepare the statement -> Bind variables to the prepared statement
		$sql = "SELECT * FROM data_table WHERE data_id=? LIMIT 1";
		$stmt = $db_connection->prepare($sql);
		$stmt->bind_param('i', $data_id);

		// Execute the prepared statement -> Store result -> Store number of rows from query
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($data_id, $data1, $data2, $data3);
		$stmt->fetch();

		// Close connection
		$stmt->close();

		// Put data into array so that it can be returned
		$data_data = array(
			'data_id' => $data_id,
			'data1' => $data1,
			'data2' => $data2,
			'data3' => $data3
		);
		
		return $data_data;
	}
?>