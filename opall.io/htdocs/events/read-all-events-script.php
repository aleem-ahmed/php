<?php
	/* 
	* %%%%%%%%%%%%%%%%%%%%%%%%%%%%% *
	* %%% READ ALL TASKS SCRIPT %%% *
	* %%%%%%%%%%%%%%%%%%%%%%%%%%%%% *
	*/
	/* INCLUDE SCRIPTS */
	require $_SERVER['DOCUMENT_ROOT'].'/common/functions/event-functions.php';

	/* [INTITIALIZE] VARIABLES (Ordered by SQL table) */
	$table_rows = '';

	$user_id_error = '';
	$user_events_id_error = '';

	/*** [FETCH DATA] USER ID CHECK & USER EVENTS ID ***/
	// USER ID //
	if (isset($_SESSION['user_id'])) {
		$user_id = trim($_SESSION['user_id']);
		
		// USER EVENTS ID //
		if (verify_user_events_id_exists($link, $user_id)) {
			$user_events_id = fetch_user_events_id($link, $user_id);
		}
		else {
			// [ERROR] User Events ID not found (Verification Error) //
			$user_events_id_error = 'No "user_events_id" found. User may not be verfied..';
		}
	}
	else {
		// [ERROR] User ID Not Set (Not Logged In) //
		$user_id_error = 'No "user_id" set.';
	}

	/* GET USER EVENTS ID */
	if (
		empty($user_events_id_error) &&
		empty($user_id_error)
	) {
		// Set query -> Prepare the statement -> Bind variables to the prepared statement
		$sql = "SELECT user_events_id FROM user_events WHERE user_id=?";
		$stmt = $link -> prepare($sql);
		$stmt -> bind_param('i', $user_id);

		// Execute the prepared statement -> Store result -> Store number of rows from query -> Bind result variables -> Fetch the associated variables
		$stmt -> execute(); 
		$stmt -> store_result(); 

		$row_count = mysqli_stmt_num_rows($stmt);
		$stmt -> bind_result($user_events_id); 
		$stmt -> fetch();

		// Close connection
		$stmt -> close();
		
		// If a user_events_id was returned get the data
		if ($row_count > 0) {
			$user_events_id_error = '';

		} else {
			$user_events_id_error = 'No #user_events_id was found.';
		}
	}

	/* GET DATA FROM DATABASE */
	if (empty($user_eventss_id_error) && empty($user_id_error)) {
		
		$stmt = $link -> prepare("SELECT event_id, days, time_start, time_end, period_start, period_end, type, name FROM event WHERE user_events_id=?");
		$stmt -> bind_param('i', $user_events_id);
		$stmt -> execute(); 
		$stmt -> store_result(); 
		$stmt -> bind_result($event_id, $days, $time_start, $time_end, $period_start, $period_end, $type, $name); 

		while ($stmt -> fetch()) { 
			$table_rows .= '
				<tr class="clickable-row" data-href="/events/read-event/?event_id=' . $event_id . '">
					<td>' . $name . '</td>
					<td>' . $type . '</td>
					<td>' . $days . '</td>
					<td>' . $time_start . '</td>
					<td>' . $time_end . '</td>
					<td>' . $period_start . '</td>
					<td>' . $period_end . '</td>
				</tr>
			';
		}
	}
?>