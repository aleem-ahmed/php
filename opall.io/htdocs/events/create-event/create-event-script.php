<?php
	/* 
	 * %%%%%%%%%%%%%%%%%%%%%%%%%% *
	 * %%% CREATE DATA SCRIPT %%% *
	 * %%%%%%%%%%%%%%%%%%%%%%%%%% *
	 * 
	*/

	/*** [INCLUDE FILES] ***/
	require $_SERVER['DOCUMENT_ROOT'].'/common/functions/event-functions.php';
	

	/*** [INITIALIZE FLAG + ERRORS] ***/
	$authorized_and_validated = FALSE;
	$user_id_error = $user_events_id_error = '';


	/*** [AUTHORIZATION & VALIDATION TEST] ***/
	// USER ID //
	if (isset($_SESSION['user_id'])) {
		$user_id = trim($_SESSION['user_id']);
		
		// USER EVENTS ID //
		if (verify_user_events_id_exists($link, $user_id)) {
			$user_events_id = fetch_user_events_id($link, $user_id);
			$authorized_and_validated = TRUE;
		}
		// [ERROR] User events ID not found (Verification Error) //
		else { $user_events_id_error = 'No "user_events_id" found. User may not be verfied..'; }
	}
	// [ERROR] User ID Not Set (Not Logged In) //
	else { $user_id_error = 'No "user_id" set.'; }

	if ($authorized_and_validated == TRUE) {
		$days_error = $time_start_error = $time_end_error = $repeating_error = $period_start_error = $period_end_error = $type_error = $name_error = $description_error = '';

		$days = $mon_val = $tue_val = $wed_val = $thu_val = $fri_val = $sat_val = $sun_val = $time_start = $time_end = $repeating = $period_start = $period_end = $type = $name = $description = '';

		// MTWTFSS Checkboxes //
		if (isset($_GET['mon_val'])) { if ($_GET['mon_val']) { $mon_val = 'checked'; } }
		if (isset($_GET['tue_val'])) { if ($_GET['tue_val']) { $tue_val = 'checked'; } }
		if (isset($_GET['wed_val'])) { if ($_GET['wed_val']) { $wed_val = 'checked'; } }
		if (isset($_GET['thu_val'])) { if ($_GET['thu_val']) { $thu_val = 'checked'; } }
		if (isset($_GET['fri_val'])) { if ($_GET['fri_val']) { $fri_val = 'checked'; } }
		if (isset($_GET['sat_val'])) { if ($_GET['sat_val']) { $sat_val = 'checked'; } }
		if (isset($_GET['sun_val'])) { if ($_GET['sun_val']) { $sun_val = 'checked'; } }
		
		// Time Start //
		if (isset($_GET['time_start'])) {
			$time_start = $_GET['time_start'];
			$time_start = filter_var($time_start, FILTER_SANITIZE_STRING);
		}

		if (isset($_GET['time_start_error'])) {
			$time_start_error = $_GET['time_start_error'];
			$time_start_error = filter_var($time_start_error, FILTER_SANITIZE_STRING);
		}
		
		// Time End //
		if (isset($_GET['time_end'])) {
			$time_end = $_GET['time_end'];
			$time_end = filter_var($time_end, FILTER_SANITIZE_STRING);
		}

		if (isset($_GET['time_end_error'])) {
			$time_end_error = $_GET['time_end_error'];
			$time_end_error = filter_var($time_end_error, FILTER_SANITIZE_STRING);
		}

		// Repeating //
		$repeating_val = '';

		if (isset($_GET['repeating_val'])) { if ($_GET['repeating_val']) { $repeating_val = 'checked'; } }

		// Period Start //
		if (isset($_GET['period_start'])) {
			$period_start = $_GET['period_start'];
			$period_start = filter_var($period_start, FILTER_SANITIZE_STRING);
		}

		if (isset($_GET['period_start_error'])) {
			$period_start_error = $_GET['period_start_error'];
			$period_start_error = filter_var($period_start_error, FILTER_SANITIZE_STRING);
		}

		// Period End //
		if (isset($_GET['period_end'])) {
			$period_end = $_GET['period_end'];
			$period_end = filter_var($period_end, FILTER_SANITIZE_STRING);
		}

		if (isset($_GET['period_end_error'])) {
			$period_end_error = $_GET['period_end_error'];
			$period_end_error = filter_var($period_end_error, FILTER_SANITIZE_STRING);
		}

		// Type //
		if (isset($_GET['type'])) {
			$type = $_GET['type'];
			$type = filter_var($type, FILTER_SANITIZE_STRING);
		}

		if (isset($_GET['type_error'])) {
			$type_error = $_GET['type_error'];
			$type_error = filter_var($type_error, FILTER_SANITIZE_STRING);
		}
		
		// Name //
		if (isset($_GET['name'])) {
			$name = $_GET['name'];
			$name = filter_var($name, FILTER_SANITIZE_STRING);
		}

		if (isset($_GET['name_error'])) {
			$name_error = $_GET['name_error'];
			$name_error = filter_var($name_error, FILTER_SANITIZE_STRING);
		}
		
		// Description //
		if (isset($_GET['description'])) {
			$description = $_GET['description'];
			$description = filter_var($description, FILTER_SANITIZE_STRING);
		}

		if (isset($_GET['description_error'])) { 
			$description_error = $_GET['description_error'];
			$description_error = filter_var($description_error, FILTER_SANITIZE_STRING);
		}
	}
	/* [DISPLAY NO DATA] The User Should Not View the Data **/
	else {
		$days_error = $time_start_error = $time_end_error = $repeating_error = $period_start_error = $period_end_error = $type_error = $name_error = $description_error = '';
		$days = $mon_val = $tue_val = $wed_val = $thu_val = $fri_val = $sat_val = $sun_val = $time_start = $time_end = $repeating = $period_start = $period_end = $type = $name = $description = '';
	}

	/* PROCCESS FORM DATA AFTER SUBMISSION */
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		/* Days */
		$days = '';

		/* MTWTFSS */
		// If there is anything in the post then set the value to 1 and add it to $days else set value to 0
		if (isset($_POST['mon'])) { $mon = '1'; $mon_val = 'checked'; $days .= 'Mon '; } else { $mon = '0'; $mon_val = ''; }
		if (isset($_POST['tue'])) { $tue = '1'; $tue_val = 'checked'; $days .= 'Tue '; } else { $tue = '0'; $tue_val = ''; }
		if (isset($_POST['wed'])) { $wed = '1'; $wed_val = 'checked'; $days .= 'Wed '; } else { $wed = '0'; $wed_val = ''; }
		if (isset($_POST['thu'])) { $thu = '1'; $thu_val = 'checked'; $days .= 'Thu '; } else { $thu = '0'; $thu_val = ''; }
		if (isset($_POST['fri'])) { $fri = '1'; $fri_val = 'checked'; $days .= 'Fri '; } else { $fri = '0'; $fri_val = ''; }
		if (isset($_POST['sat'])) { $sat = '1'; $sat_val = 'checked'; $days .= 'Sat '; } else { $sat = '0'; $sat_val = ''; }
		if (isset($_POST['sun'])) { $sun = '1'; $sun_val = 'checked'; $days .= 'Sun '; } else { $sun = '0'; $sun_val = ''; }

		/* Time Start */
		/* [PROCCESS DATA] Data is not empty check it now */
		if (!empty($_POST['time_start'])) {
			$time_start = trim($_POST['time_start']);
			$time_start = filter_var($time_start, FILTER_SANITIZE_STRING);
		}
		else { $time_start_error = 'Please enter a start time for this event.'; }

		/* Time End */
		/* [PROCCESS DATA] Data is not empty check it now */
		if (!empty($_POST['time_end'])) {
			$time_end = trim($_POST['time_end']);
			$time_end = filter_var($time_end, FILTER_SANITIZE_STRING);
		}
		else { $time_end_error = 'Please enter a end time for this event.'; }

		/* Repeating */
		/* [PROCCESS DATA] Data is not empty check it now */
		if (isset($_POST['repeating'])) { $repeating = '1'; $repeating_val = 'checked'; } else { $repeating = '0'; $repeating_val = ''; }

		/* Period Start */
		/* [PROCCESS DATA] Data is not empty check it now */
		if (!empty($_POST['period_start'])) {
			$period_start = trim($_POST['period_start']);
			$period_start = filter_var($period_start, FILTER_SANITIZE_STRING);
			
		}
		else { $period_start_error = 'Please enter a period end for this event.'; }

		/* Period End */
		/* [PROCCESS DATA] Data is not empty check it now */
		if (!empty($_POST['period_end'])) {
			$period_end = trim($_POST['period_end']);
			$period_end = filter_var($period_end, FILTER_SANITIZE_STRING);
		}
		else { $period_end_error = 'Please enter period start for this event.'; }

		// Name //
		$name = trim($_POST['name']);
		$name = filter_var($name, FILTER_SANITIZE_STRING);

		/* [PROCCESS DATA] Data is not empty check it now */
		if (!empty($_POST['name'])) {}
		/* [ERROR] Data Empty */
		else { $name_error = 'Please enter a name for this event.'; }

		// Type //
		/* [PROCCESS DATA] Data is not empty check it now */
		if (!empty($_POST['type'])) {
			$type = trim($_POST['type']);
			$type = filter_var($type, FILTER_SANITIZE_STRING);
		}
		else { $type_error = 'Please enter a type for this event.'; }

		// Description //
		/* [PROCCESS DATA] Data is not empty check it now */
		if (!empty($_POST['description'])) {
			$description = trim($_POST['description']);
			$description = filter_var($description, FILTER_SANITIZE_STRING);
		}
		else { $description_error = 'Please enter a description for this event.'; }

		/* NO ERRORS -> INSERT DATA */
		if (
			($authorized_and_validated == TRUE) &&
			empty($time_start_error) &&
			empty($time_end_error) &&
			empty($period_start_error) &&
			empty($period_end_error) &&
			empty($type_error) &&
			empty($name_error) &&
			empty($description_error)
		) {
			// Set query -> Prepare the statement -> Bind variables to the prepared statement
			$sql = "
				INSERT INTO event(
					user_events_id,
					days,
					mon, tue, wed, thu, fri, sat, sun,
					time_start,
					time_end,
					repeating,
					period_start,
					period_end,
					type,
					name,
					description
				)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
			";

			$stmt = $link->prepare($sql);
			$stmt->bind_param(
				'issssssssssssssss',
				$user_events_id,
				$days,
				$mon, $tue, $wed, $thu, $fri, $sat, $sun,
				$time_start,
				$time_end,
				$repeating,
				$period_start,
				$period_end,
				$type,
				$name,
				$description
			);

			// Attempt to execute the prepared statement
			if (mysqli_stmt_execute($stmt)) {
				// Close statement -> Close connection -> redirect and exit the php script
				mysqli_stmt_close($stmt);
				mysqli_close($link);
				header("Location: /events/?event_updated");
				exit();
			}
			// Close statement just in case
			mysqli_stmt_close($stmt);
				
			header("Location: /events/?event_updated");
		}

		/* [ERROR -> REDIRECT] With Invalid Data */
		else {
			// Formulate the redirect URL
			$redirect_url_content = 
				'event_id=' . $event_id .
				'&event_id_error=' . $event_id_error .

				'&user_id_error=' . $user_id_error .
				'&user_events_id_error=' . $user_events_id_error .
				'&event_ownership_error=' . $event_ownership_error .

				'&mon_val=' . $mon_val .
				'&tue_val=' . $tue_val .
				'&wed_val=' . $wed_val .
				'&thu_val=' . $thu_val .
				'&fri_val=' . $fri_val .
				'&sat_val=' . $sat_val .
				'&sun_val=' . $sun_val .

				'&time_start=' . $time_start .
				'&time_start_error=' . $time_start_error .

				'&time_end=' . $time_end .
				'&time_end_error=' . $time_end_error .

				'&repeating_val=' . $repeating_val .

				'&period_start=' . $period_start .
				'&period_start_error=' . $period_start_error .

				'&period_end=' . $period_end .
				'&period_end_error=' . $period_end_error .

				'&type=' . $type .
				'&type_error=' . $type_error .
				
				'&name=' . $name .
				'&name_error=' . $name_error .

				'&description=' . $description .
				'&description_error=' . $description_error
			;

			// This redirects if something is not valid
			header("Location: /events/create-event/?$redirect_url_content");
		}
	}
?>