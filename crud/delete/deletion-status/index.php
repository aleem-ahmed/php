<!----- DELETION STATUS PAGE ----->
<!-- TOP -->
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/crud/common/top.php'; ?>

<?php
	// Get "status" from URL
	if (isset($_GET['status'])) {
		$status = trim($_GET['status']);
		$status = filter_var($status, FILTER_SANITIZE_STRING);
	}
	else { $status = ''; }

	// Get "data_id" from URL
	if (isset($_GET['data_id'])) {
		$data_id = trim($_GET['data_id']);
		$data_id = filter_var($data_id, FILTER_SANITIZE_STRING);
	}
	else { $data_id = ''; }

	// Get "data_id" from URL
	if (isset($_GET['data_id_error'])) {
		$data_id_error = trim($_GET['data_id_error']);
		$data_id_error = filter_var($data_id_error, FILTER_SANITIZE_STRING);
	}
	else { $data_id_error = ''; }

	// Get "authorized_error" from URL
	if (isset($_GET['authorized_error'])) {
		$authorized_error = trim($_GET['authorized_error']);
		$authorized_error = filter_var($authorized_error, FILTER_SANITIZE_STRING);
	}
	else { $authorized_error = ''; }
?>

<?php	
	// [DISPLAY] The Status
	echo '
		<h1 style="color: green;">' . $status . '</h1><br>

		<h3>
			<span>
				data_id: ' . $data_id . '<br>
				data_id_error: ' . $data_id_error . '<br>
				authorized_error: ' . $authorized_error. '<br>
			<span>
		</h3>
	';
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/crud/common/bottom.php'; ?>