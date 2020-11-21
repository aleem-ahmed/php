<!-- [READ] Event Script -->
<?php
	/* INCLUDE SCRIPTS */
	include_once $_SERVER['DOCUMENT_ROOT'].'/common/functions/event-functions.php';

	/*** [INITIALIZE] variables (Ordered by SQL table) ***/
	// ID Errors -> event Data
	$everything_is_ok = FALSE;

	$user_id_error = '';
	$event_id_error = '';

	$user_events_id_error = '';
	$event_ownership_error = '';

	$days = '';
	$mon = '';
	$tue = '';
	$wed = '';
	$thu = '';
	$fri = '';
	$sat = '';
	$sun = '';
	$time_start = '';
	$time_end = '';
	$repeating = '';
	$period_start = '';
	$period_end = '';
	$type = '';
	$name = '';
	$description = '';
	$created = '';

	/*** [EXISTANCE STATUS + OWNERSHIP + FETCH DATA] USER ID, USER_eventS_ID, & event_ID ***/
	// USER ID //
	if (isset($_SESSION['user_id'])) {
		$user_id = trim($_SESSION['user_id']);
		
		// USER eventS ID //
		if (verify_user_events_id_exists($link, $user_id)) {
			$user_events_id = fetch_user_events_id($link, $user_id);

			// event ID //
			if (isset($_GET['event_id'])) {
				if (!empty($_GET['event_id'])) {
					$event_id = trim($_GET['event_id']);

					// event EXISTANCE & OWNERSHIP //
					if (verify_event_exists($link, $event_id)) {
						if (verify_event_ownership($link, $event_id, $user_events_id)) {
							$everything_is_ok = TRUE;
						}
						else {
							// [ERROR] Ownership //
							$event_ownership_error = 'This event does not belong to you.';
						}
					}
					else {
						// [ERROR] event Not Existant //
						$event_id_error = 'event does not exists.';
					}
				}
				else {
					// [ERROR] event ID Not Specified //
					$event_id_error = 'No "event_id" given.';
				}
			}
			else {
				// [ERROR] event ID Not Set //
				$event_id_error = 'No "event_id" set.';
			}
		}
		else {
			// [ERROR] User events ID not found (Verification Error) //
			$user_events_id_error = 'No "user_events_id" found. User may not be verfied..';
		}
	}
	else {
		// [ERROR] User ID Not Set (Not Logged In) //
		$user_id_error = 'No "user_id" set.';
	}

	/*** [FETCH DATA] ALL VARIABLES ***/
	if ($everything_is_ok == TRUE) {
		// Get the event data from the DB
		$event_data = fetch_event_data_array($link, $event_id);

		// Set variables as the data retrieved from the DB
		$days = $event_data['days'];
		$mon = $event_data['mon'];
		$tue = $event_data['tue'];
		$wed = $event_data['wed'];
		$thu = $event_data['thu'];
		$fri = $event_data['fri'];
		$sat = $event_data['sat'];
		$sun = $event_data['sun'];
		$time_start = $event_data['time_start'];
		$time_end = $event_data['time_end'];
		$repeating = $event_data['repeating'];
		$period_start = $event_data['period_start'];
		$period_end = $event_data['period_end'];
		$type = $event_data['type'];
		$name = $event_data['name'];
		$description = $event_data['description'];
		$created = $event_data['created'];
	}
?>