<?php 
	/* 
	 * %%%%%%%%%%%%%%%%%%%%%%%%%% *
	 * %%% UPDATE DATA SCRIPT %%% *
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
	$authorized_error = $data_id_error = $data_error = '';




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




	/*** [SET DATA TO DB VAL OR INVALID] Set Variables to Either URL Val. (If exists) or DB Val ***/
	if ($authorized_and_validated == TRUE) {
		/* [FETCH DATA] Get Data from DB */
		$fetched_data = fetch_data_array($db_connection, $data_id);
		// "data1" // "data1_error" //
		if (isset($_GET['invalid_data1'])) {
			$data1 = trim($_GET['invalid_data1']);
			$data1 = filter_var($data1, FILTER_SANITIZE_STRING);
		}
		else { $data1 = $fetched_data['data1']; }

		if (isset($_GET['data1'])) {
			$data1 = trim($_GET['data1']);
			$data1 = filter_var($data1, FILTER_SANITIZE_STRING);
		}
		else { $data = $fetched_data['data1']; }

		if (isset($_GET['data1_error'])) {
			$data1_error = trim($_GET['data1_error']);
			$data1_error = filter_var($data1_error, FILTER_SANITIZE_STRING);
		}
		else { $data1_error = ''; }



		// "data2" // "data2_error" //
		if (isset($_GET['invalid_data2'])) {
			$data2 = trim($_GET['invalid_data2']);
			$data2 = filter_var($data2, FILTER_SANITIZE_STRING);
		}
		else { $data2 = ''; }

		if (isset($_GET['data2'])) {
			$data2 = trim($_GET['data2']);
			$data2 = filter_var($data2, FILTER_SANITIZE_STRING);
		}
		else { $data2 = $fetched_data['data2']; }

		if (isset($_GET['data2_error'])) {
			$data2_error = trim($_GET['data2_error']);
			$data2_error = filter_var($data2_error, FILTER_SANITIZE_STRING);
		}
		else { $data2_error = ''; }



		// "data3" // "data3_error" //
		if (isset($_GET['invalid_data3'])) {
			$data3 = trim($_GET['invalid_data3']);
			$data3 = filter_var($data3, FILTER_SANITIZE_STRING);
		}
		else { $data3 = ''; }

		if (isset($_GET['data3'])) {
			$data3 = trim($_GET['data3']);
			$data3= filter_var($data3, FILTER_SANITIZE_STRING);
		}
		else { $data3 = $fetched_data['data3']; }

		if (isset($_GET['data3_error'])) {
			$data3_error = trim($_GET['data3_error']);
			$data3_error = filter_var($data3_error, FILTER_SANITIZE_STRING);
		}
		else { $data3_error = ''; }
	}
	else {
		/* [DISPLAY NO DATA] The User Should Not View the Data **/
		// Data Items //
		$data1 = $data2 = $data3 ='';
	}




	/*** [FORM SUBMISSION] Proccess Form Data + Insert New Data into DB ***/
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		/* [FORM DATA VALIDATION TEST] Check the Fields */
		


		// Data 1 //
		if (!empty($_POST['data1'])) { 
			$data1 = trim($_POST['data1']);
			$data1 = filter_var($data1, FILTER_SANITIZE_STRING);

			// Set Data
			if ((strlen($data1) <= 4) && (strlen($data1) >= 50)) {
				// Store invalid data into "$invalid_data1"
				$invalid_data1 = trim($_POST['data1']);
				$invalid_data1 = filter_var($invalid_data1, FILTER_SANITIZE_STRING);
			}
			else {
				$data1 = trim($_POST['data1']);
				$data1 = filter_var($data1, FILTER_SANITIZE_STRING);
			}

			// Set Error
			if (strlen($data1) <= 4) { $data1_error = "Value too SHORT. (Must be longer than 4 char)"; }
			if (strlen($data1) >= 50) { $data1_error = "Value too LONG. (Must be Shorter than 50 char)"; }
			
		}
		/* [ERROR] No Data Passed */
		else { $data1_error = 'Please enter data.'; }



		// Data 2 //
		if (!empty($_POST['data2'])) { 
			$data2 = trim($_POST['data2']);
			$data2 = filter_var($data2, FILTER_SANITIZE_STRING);

			// Set Data
			if ((strlen($data2) <= 4) && (strlen($data2) >= 50)) {
				// Set data to be sent back
				$invalid_data2 = trim($_POST['data2']);
				$invalid_data2 = filter_var($invalid_data2, FILTER_SANITIZE_STRING);
			}

			// Set Error
			if (strlen($data2) <= 4)	{ $data2_error = "Value too SHORT. (Must be longer than 4 char)"; }
			if (strlen($data2) >= 50)	{ $data2_error = "Value too LONG. (Must be Shorter than 50 char)"; }

		}
		/* [ERROR] No Data Passed */
		else { $data2_error = 'Please enter data.'; }


		// Data 3 //
		if (!empty($_POST['data3'])) { 
			$data3 = trim($_POST['data3']);
			$data3 = filter_var($data3, FILTER_SANITIZE_STRING);

			// Set Data
			if ((strlen($data3) <= 4) && (strlen($data3) >= 50)) {
				// Set data to be sent back
				$invalid_data3 = trim($_POST['data3']);
				$invalid_data3 = filter_var($invalid_data3, FILTER_SANITIZE_STRING);
			}

			// Set Error
			if (strlen($data3) <= 4)	{ $data3_error = "Value too SHORT. (Must be longer than 4 char)"; }
			if (strlen($data3) >= 50)	{ $data3_error = "Value too LONG. (Must be Shorter than 50 char)"; }

		}
		/* [ERROR] No Data Passed */
		else { $data3_error = 'Please enter data.'; }



		/* [UPDATE DATA] In Database */
		if (
			($authorized_and_validated == TRUE) &&
			empty($data1_error) &&
			empty($data2_error) &&
			empty($data3_error)
		) {
			// Set query -> Prepare the statement -> Bind variables to the prepared statement
			$sql = "UPDATE data_table SET data1=?, data2=?, data3=? WHERE data_id=?";

			$stmt = $db_connection->prepare($sql);
			$stmt->bind_param('sssi', $data1, $data2, $data3, $data_id);

			// Attempt to execute the prepared statement
			if (mysqli_stmt_execute($stmt)) {
				// Close statement -> Close connection -> redirect and exit the php script
				mysqli_stmt_close($stmt);
				mysqli_close($link);
				header("Location: /crud/?status=Data%20Updated%20Successfully");
				exit();
			}
			// Close statement just in case
			mysqli_stmt_close($stmt);
		}



		/* [ERROR -> REDIRECT] With Invalid Data */
		else {
			// Formulate the redirect URL
			$redirect_url_content =
				'invalid_data1=' . $invalid_data1 .
				'&data1_error=' . $data1_error .
				'&data1=' . $data1 .

				'&invalid_data2=' . $invalid_data2 .
				'&data2_error=' . $data2_error .
				'&data2=' . $data2 .

				'&invalid_data3=' . $invalid_data3 .
				'&data3_error=' . $data3_error .
				'&data3=' . $data3
			;

			// Redirect
			header("Location: /crud/update/?$redirect_url_content");
			exit();

			// Close statement just in case
			mysqli_stmt_close($stmt);
		}
	}
?>