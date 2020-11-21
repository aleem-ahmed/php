<?php
	/* 
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% *
	 * %%% READ ALL CONTACTS SCRIPT %%% *
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% *
	*/
	/*** [INITIALIZE FLAG + ERRORS] ***/
	$authorized = $authorized_and_validated = FALSE;
	$user_id_error = $user_contacts_id_error = '';

	

	/*** [AUTHORIZATION + VALIDATION] Check if Data Exists & Meets All Credentials ***/
	// USER ID //
	if (isset($_SESSION['user_id'])) {
		$user_id = trim($_SESSION['user_id']);
		$user_id = filter_var($user_id, FILTER_SANITIZE_NUMBER_INT);
		
		// USER TASKS ID //
		if (verify_user_contacts_id_exists($link, $user_id)) {
			$user_contacts_id = fetch_user_contacts_id($link, $user_id);
			$authorized_and_validated = TRUE;
		}
		// [ERROR] User Contacts ID not found (Verification Error) //
		else { $user_contacts_id_error = 'No "user_tasks_id" found. User may not be verfied..'; }
	}
	// [ERROR] User ID not found (Verification Error) //
	else { $user_id_error = 'No "user_id" set.'; }



	/*** [DISPLAY DATA] In Document ***/
	if ($authorized_and_validated == TRUE) {
		$table_rows = '';

		/* [FETCH] Get the ID's of the Contacts Who Have Associations */
		$contact_id_b = fetch_added_contact_ids($link, $user_contacts_id);

		while ($stmt->fetch()) {
			// Fetch the spe
			$contact_id_b_details = fetch_contact_id_b_details($link, $contact_id_b);

			$table_rows .= '
				<tr class="clickable-row" data-href="/your-profile/your-contacts-list/?contact_id=' . $contact_id_b . '">

					<td style="width: 80px;">' . $contact_id_b_details['username'] . '</td>
				
				</tr>
			';
		}
	}
	else { $table_rows = ''; }

	if ($user_action == 'add contact') {

	}
?>