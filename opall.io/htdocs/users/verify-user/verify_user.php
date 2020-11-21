<?php
	/* 
	 * %%%%%%%%%%%%%%%%%%%%%%%%%% *
	 * %%% VERIFY USER SCRIPT %%% *
	 * %%%%%%%%%%%%%%%%%%%%%%%%%% *
	*/
	/*** [INCLUDE FILES] Functions ***/
	include $_SERVER['DOCUMENT_ROOT'].'/common/functions/verification-functions.php';


	/*** [INITIALIZE FLAG + ERRORS] ***/
	$authorized_and_validated = FALSE;
	$user_id_error = $vkey_error = '';


	/*** [AUTHORIZATION & VALIDATION TEST] (Check Logged in &/or user allowed to create data here) ***/
	if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];

		// Check if password is empty
		if (isset($_GET['vkey'])) {
			if (!empty($_GET['vkey'])) {
				$vkey= trim($_GET['vkey']);
				$vkey = filter_var($vkey, FILTER_SANITIZE_STRING);

				// Check if the vkey is correct
				if (verify_vkey($link, $user_id, $vkey)) {
					$authorized_and_validated = TRUE;
				}
				/* [ERRROR] vkey is not correct */
				else { $vkey_error = '"vkey" is not correct.'; }
			}
			/* [ERROR] No "vkey" Specified */	
			else { $vkey_error = 'No "vkey" is given.'; }
		}
		/* [ERROR] No "vkey" Set */	
		else { $vkey_error = 'No "vkey" is set.'; }
	}
	else { $user_id_error = 'No "user_id" set.'; }
	
	

	/*** [VERIFICATION PROCCESS] ***/
	// If there is no error check of the vkey is valid
	if ($authorized_and_validated == TRUE) {
		// Check if user is already verified //
		$already_verified = user_verified_check($link, $user_id);

		if ($already_verified == FALSE) {
			// Verify the user //
			verify_user($link, $user_id);

			// Initialize connector tables
			initialize_user_tasks_row($link, $user_id);
			initialize_user_events_row($link, $user_id);
			initialize_user_contacts_row($link, $user_id);
			initialize_user_notifications_row($link, $user_id);

			// Notify User
			$verification_status = '
				<h1>Successfully Verified!</h1><br>
				<p><a href="/your-account">Go to Your Account page.</a></p>
			';
		}
		else {
			// Notify User
			$verification_status = '
				<h1>Something went wrong verifying your account..</h1><br>
				<p>Maybe you are already verfied?</p>
				<p>Or the verification code is wrong?</p>
				<p>Or the username for that verification code is wrong?</p>
			';
		}
	}
	else { $vkey = ''; }
?>