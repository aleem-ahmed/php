<?php
	/* 
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% *
	 * %%% READ SINGLE DATA SCRIPT %%% *
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% *
	 * 
	 * NOTE: This does not include checking to see if the data belongs to the user. 
	 * Add that to the "AUTHORIZATION + VALIDATION" section.
	 */

	/*** [INCLUDE] Functions ***/
	include $_SERVER['DOCUMENT_ROOT'].'/crud/common/db_connection.php';
	include $_SERVER['DOCUMENT_ROOT'].'/crud/common/functions.php';




	/*** [INITIALIZE] Variables ***/
	$authorized = $authorized_and_validated = FALSE;

	$authorized_error = $data_id_error = '';




	/*** [AUTHORIZATION + VALIDATION] Check if Data Exists & Meets All Credentials ***/
	// [AUTHORIZATION CHECK] //
	if (1 == 1) {
		$authorized = TRUE;

		if (isset($_GET['data_id'])) {
			if (!empty($_GET['data_id'])) {
				$data_id = trim($_GET['data_id']);
				$data_id = filter_var($data_id, FILTER_SANITIZE_NUMBER_INT);
	
				if (verify_data_exists($db_connection, $data_id)) {
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
	// [ERROR] Data Ownership //
	else { $authorized_error = 'This data is not owned by yours to view.'; }




	/*** [DISPLAY DATA] INTO DOCUMENT ***/
	if (
		($authorized_and_validated == TRUE) &&
		($authorized == TRUE) &&
		empty($error)
	) {
		$table_row = '';
		
		$stmt = $db_connection->prepare("SELECT data_id, data1, data2, data3 FROM data_table WHERE data_id=?");
		$stmt->bind_param('i', $data_id);
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($data_id, $data1, $data2, $data3); 

		while ($stmt->fetch()) { 
			$table_row .= '
				<tr class="clickable-row" data-href="/crud/read/?data_id=' . $data_id . '">

					<td style="width: 100px;">' . $data_id . '</td>

					<td>' . $data1 . '</td>
					<td>' . $data2 . '</td>
					<td>' . $data2 . '</td>

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
	// Somethings wrong display nothing in table
	else { $table_row = ''; }
?>