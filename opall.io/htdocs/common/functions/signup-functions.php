<?php
	/* [VERIFY] Email is not taken */
	function check_email_availability($link, $email) {
		$row_count = 0;

		// Set query //
		$sql = "SELECT user_id FROM user WHERE email=?";

		// Prepare // Bind // Execute // Store //
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, 's', $email);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);

		// Store number of rows from query //
		$row_count = mysqli_stmt_num_rows($stmt);

		// Close statement //
		mysqli_stmt_close($stmt);

		if ($row_count == 0) { $status = TRUE; } else { $status = FALSE; }

		return $status;
	}



	/* [VERIFY] Username is not taken */
	function check_username_availability($link, $username) {
		$row_count = 0;

		// Set query //
		$sql = "SELECT user_id FROM user WHERE username=?";

		// Prepare // Bind // Execute // Store //
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, 's', $username);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);

		// Store number of rows from query //
		$row_count = mysqli_stmt_num_rows($stmt);

		// Clost statement //
		mysqli_stmt_close($stmt);

		if ($row_count == 0) { $status = TRUE; } else { $status = FALSE; }

		return $status;
	}
?>