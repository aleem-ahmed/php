<?php
	/* 
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%% *
	 * %%% READ ALL DATA SCRIPT %%% *
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%% *
	 * 
	 * NOTE: This does not include checking to see if the data belongs to the user. 
	 * Add that to the "AUTHORIZATION + VALIDATION" section.
	 */

	/*** [INCLUDE] Functions ***/
	include $_SERVER['DOCUMENT_ROOT'].'/crud/common/db_connection.php';
	include $_SERVER['DOCUMENT_ROOT'].'/crud/common/functions.php';




	/*** [INITIALIZE FLAG + ERRORS] ***/
	$authorized = $validated = FALSE;

	$error = '';




	/*** [AUTHORIZATION + VALIDATION] Check if Data Exists & Meets All Credentials ***/
	// [AUTHORIZATION CHECK] //
	if (1 == 1) {
		$authorized = TRUE;

		// [VALIDATION CHECK] //
		if (1 == 1) {
			$validated = TRUE;
		}
		// [ERROR] //
		else { $error = 'Error!'; }
	}
	// [ERROR] //
	else { $error = 'Error!'; }




	/*** [DISPLAY DATA] IN DOCUMENT ***/
	if (
		($authorized == TRUE) &&
		($validated == TRUE) &&
		empty($error)
	) {
		$table_rows = '';

		$stmt = $db_connection->prepare("SELECT data_id, data1, data2, data3 FROM data_table");
		$stmt->execute(); 
		$stmt->store_result(); 
		$stmt->bind_result($data_id, $data1, $data2, $data3); 

		while ($stmt->fetch()) { 
			$table_rows .= '
				<tr class="clickable-row" data-href="/crud/read/?data_id=' . $data_id . '">

					<td style="width: 100px;">' . $data_id . '</td>

					<td>' . $data1 . '</td>
					<td>' . $data2 . '</td>
					<td>' . $data3 . '</td>

					<td style="width: 80px;">
						<a href="/crud/read/?data_id=' . $data_id . '">Read</a>
					</td>

					<td style="width: 80px;">
						<a href="/crud/update/?data_id=' . $data_id . '">Update</a>
					</td>

					<td style="width: 80px;">
						<a href="/crud/delete/?data_id=' . $data_id . '">Delete</a>
					</td>
				
				</tr>
			';
		}
	}

	else { $table_rows = ''; }
?>