<?php
	/* 
	 * %%%%%%%%%%%%%%%%%%%%%%%%%% *
	 * %%% DELETE DATA SCRIPT %%% *
	 * %%%%%%%%%%%%%%%%%%%%%%%%%% *
	 * 
	 * NOTE: This does not include checking to see if the data belongs to the user. 
	 * Add that to the "AUTHORIZATION + VALIDATION" section.
	 * The reason for "INITIALIZE" then "UPDATE" is set a variable incase the user 
	 * does not pass the "AUTHORIZATION"	
	 * 
	 */

	/*** [INCLUDE FILES] Connection & Script ***/
	include $_SERVER['DOCUMENT_ROOT'].'/crud/common/db_connection.php';
	include $_SERVER['DOCUMENT_ROOT'].'/crud/common/functions.php';
	



	/*** [INITIALIZE FLAG + ERRORS] ***/
	$authorized_and_validated = FALSE;
	$authorized_error = $data_id_error = '';




	/*** [AUTHORIZATION & VALIDATION TEST] ***/
	// [AUTHORIZATION CHECK] //
	if (1 == 1) {
		$authorized = TRUE;

		// [VALIDATION] Data ID Passed //
		if (isset($_GET['data_id'])) {
			// [VALIDATION] Data ID Not Empty //
			if (!empty($_GET['data_id'])) {
				$data_id = trim($_GET['data_id']);
				$data_id = filter_var($data_id, FILTER_SANITIZE_NUMBER_INT);

				// [VALIDATION] Data Existant //
				if (verify_data_exists($db_connection, $data_id)) {
					// [UPDATE] Flag //
					$authorized_and_validated = TRUE;
				}
				// [ERROR] Data Not Existant //
				else { $data_id_error = 'Data does not exists.'; }
			}
			// [ERROR] Data ID Not Specified //
			else { $data_id_error = 'No "data_id" given.'; }
		}
		// [ERROR] Data ID Not Set //
		else { $data_id_error = 'No "data_id" set.'; }
	}
	// [ERROR] //
	else { $authorized_error = 'Error!'; }




	/*** [PROCCESS FORM DATA] AFTER SUBMISSION ***/
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$deletion_decision = trim($_POST['deletion-decision']);
		$deletion_decision = filter_var($deletion_decision, FILTER_SANITIZE_STRING);

		if ($deletion_decision == 'yes') {
			/*** [UPDATE DATA] IN DATABASE ***/
			if ($authorized_and_validated == TRUE) {
				// Set query -> Prepare the statement -> Bind variables to the prepared statement
				$sql = "DELETE FROM data_table WHERE data_id=?";

				$stmt = $db_connection->prepare($sql);
				$stmt->bind_param('i', $data_id);

				// Attempt to execute the prepared statement
				if (mysqli_stmt_execute($stmt)) {
					// Close statement -> Close connection -> 
					mysqli_stmt_close($stmt);
					mysqli_close($db_connection);

					// Formulate URL data -> Redirect -> Exit the php script
					$redirect_url_content = 
						'status=deletion_success' .
						'&data_id=' . $data_id .
						'&data_id_error=' . $data_id_error .
						'&authorized_error=' . $authorized_error
					;

					header("Location: /crud/delete/deletion-status/?$redirect_url_content");
					exit();
				}
				// Close statement just in case
				mysqli_stmt_close($stmt);
			}



			/* [ERROR -> REDIRECT] With Invalid Data */
			else {
				// Formulate URL data
				$redirect_url_content =
					'status=deletion_error' .
					'&data_id=' . $data_id .
					'&data_id_error=' . $data_id_error .
					'&authorized_error=' . $authorized_error
				;

				// This redirects if something is not valid
				header("Location: /crud/delete/deletion-status/?$redirect_url_content");
				exit();

				// Close statement just in case
				mysqli_stmt_close($stmt);
			}
		}
		else {
			// This redirects if something is not valid
			header("Location: /crud/?status=did_not_delete_data");
		}
	}
?>