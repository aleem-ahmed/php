<?php
	/* 
	 * ==============================================
	 *   SOCIAL NETWORK
	 * ==============================================
	*/
	/* REQUEST CONTACT */
	function request_association($link, $user_contacts_id_a, $user_contacts_id_b) {
		// Set Query //
		$sql = "INSERT INTO request (user_contacts_id_a, user_contacts_id_b, accepted) VALUES (?, ?, ?)";

		// Prepare // Bind // Execute // Close //
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, 'iii', $user_contacts_id_a, $user_contacts_id_b, 0);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}



	/* ADD CONTACT */
	function create_association($link, $user_contacts_id_a, $user_contacts_id_b) {
		// Set Query //
		$sql = "INSERT INTO association (user_contacts_id_a, user_contacts_id_b) VALUES (?, ?)";

		// Prepare // Bind // Execute // Close //
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, 'ii', $user_contacts_id_a, $user_contacts_id_b);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		// Set "accepted" to 1 in request table
		$sql = "
			UPDATE request
			SET accepted = 1
			WHERE user_contacts_id_a=$user_contacts_id_a
			AND user_contacts_id_b=$user_contacts_id_b
		";

		$stmt2 = mysqli_prepare($link, $sql);
		mysqli_stmt_execute($stmt);
	}



	/* DELETE CONTACT */
	function delete_association($link, $user_contacts_id_a, $user_contacts_id_b) {}



	/* RETRIEVE CHAT MESSAGE */
	function retrieve_chat_history($link) {}



	/* INSERT CHAT MESSAGE */
	function insert_chat_message($link) {}
?>