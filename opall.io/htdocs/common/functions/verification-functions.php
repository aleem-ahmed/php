<?php
	/* 
	 * ==============================================
	 *   OTHER FUNCTIONS
	 * ==============================================
	*/
	/* [VALIDATE VKEY] Verify If vkey is correct */
	function verify_vkey($link, $user_id, $vkey) {
		// Set Query //
		$sql = "SELECT user_id, vkey FROM user WHERE user_id=? AND vkey=? LIMIT 1";

		// Prepare // Bind // Execute // Store //
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, 'is', $user_id, $vkey);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);

		// Store Num Rows //
		$row_count = mysqli_stmt_num_rows($stmt);

		// Close Statement //
		mysqli_stmt_close($stmt);

		if ($row_count == 1) { $status = TRUE; } else { $status = FALSE; }

		return $status;
	}



	/* [CHECK VERIFICATION] Check If User Already Verified */
	function user_verified_check($link, $user_id) {
		$row_count = 0;
		$status = FALSE;

		// Set Query //
		$sql = "SELECT verified FROM user WHERE user_id=? AND verified=0 LIMIT 1";

		// Prepare // Bind // Execute // Store //
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, 'i', $user_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);

		// Store Num Rows //
		$row_count = mysqli_stmt_num_rows($stmt);

		// Close Statement //
		mysqli_stmt_close($stmt);

		// Set Status //
		if ($row_count == 1) { $status = FALSE; } else { $status = TRUE; }

		return $status;
	}



	/* [VERIFY] Verify the User */
	function verify_user($link, $user_id) {
		// Set Query //
		// insert a 1 into the verified column for this user
		$sql = "UPDATE user SET verified=1 WHERE user_id=?";

		// Prepare // Bind // Execute // Close //
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, 'i', $user_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}



	/* [INITIALIZE TABLE] User Tasks (this is to enable logging tasks for this user) */
	function initialize_user_tasks_row($link, $user_id) {
		// Set Query //
		$sql = "INSERT INTO user_tasks (user_id) VALUES (?)";

		// Prepare // Bind // Execute // Close //
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, 'i', $user_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}



	/* [INITIALIZE TABLE] User Events (this is to enable to loggin events for this user) */
	function initialize_user_events_row($link, $user_id) {
		// Set Query //
		$sql = "INSERT INTO user_events (user_id) VALUES (?)";

		// Prepare // Bind // Execute // Close //
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, 'i', $user_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}



	/* [INITIALIZE TABLE] User Contacts (this is to enable to social media for this user) */
	function initialize_user_contacts_row($link, $user_id) {
		// Set Query //
		$sql = "INSERT INTO user_contacts (user_id) VALUES (?)";

		// Prepare // Bind // Execute // Close //
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, 'i', $user_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}



	/* [INITIALIZ TABLE] User Notifications (Initialize the notifications for this user) */
	function initialize_user_notifications_row($link, $user_id) {
		// Set Query //
		$sql = "INSERT INTO user_notifications (user_id) VALUES (?)";

		// Prepare // Bind // Execute // Close //
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, 'i', $user_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
?>