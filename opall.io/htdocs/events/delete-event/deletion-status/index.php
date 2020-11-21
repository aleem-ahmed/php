<!-- [DELETE] Deletion Successful Page -->
<?php
	// [INCLUDE SESSION -> NAME PAGE] Initialization file (Session and DB connection)
	include_once $_SERVER['DOCUMENT_ROOT'].'/private/common/initialization.php';
	$page_title = 'Deleted Task: ';
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/top.php'; ?>

<?php
	// Get the data from the URL 
	$status = trim($_GET['status']);

	$task_id = trim($_GET['task_id']);

	$user_id_error = trim($_GET['user_id_error']);
	$user_tasks_id_error = trim($_GET['user_tasks_id_error']);
	$task_id_error = trim($_GET['task_id_error']);
	$task_ownership_error = trim($_GET['task_ownership_error']);
	
	// [DISPLAY] the errors
	echo '
		<h1>' . $status . '</h1><br>

		<h3>
			<span>
				Task_id: ' . $task_id . '<br><br>
				user_id_error: ' . $user_id_error. '<br>
				user_tasks_id_error: ' . $user_tasks_id_error . '<br>
				task_id_error: ' . $task_id_error . '<br>
				task_ownership_error: ' . $task_ownership_error . '<br>
			<span>
		</h3>
	';
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/bottom.php'; ?>