<!-- [READ] Task Page -->
<?php
	// [INCLUDE SESSION -> NAME PAGE] Initialization file (Session and DB connection)
	include_once $_SERVER['DOCUMENT_ROOT'].'/private/common/initialization.php';
	$page_title = 'Read Task: ';
?>

<?php 
	// [NOT LOGGED REDIRECTOR]
	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
		//header('location: /swingg/login');
		//exit;
	}
?>

<?php
	// [INCLUDE SCRIPT -> UPDATE PAGE NAME] 
	include_once 'read-task-script.php';
	if (!isset($task_id)) { $task_id = ''; }
	$page_title =  $page_title .= $task_id;
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/top.php'; ?>

<?php
	// if the user is signed in display:
	if (isset($_SESSION['username'])):
?>

	<!-- Display Errors -->
	<span><?php echo $user_id_error; ?></span><br>
	<span><?php echo $user_tasks_id_error; ?></span><br>
	<span><?php echo $task_id_error; ?></span><br>
	<span><?php echo $task_ownership_error; ?></span><br>

	<div style="overflow-x: auto;">
		<table style="max-width: 300px;">
			<tr>
				<th>Task Details</th>
				<th>ID: <?php echo $task_id; ?></th>
			</tr>

			<tr>
				<td colspan="2">
					<h3>Type</h3>
					<p><?php echo $type; ?></p>
					<br>
					
					<h3>Name</h3>
					<p><?php echo $name; ?></p>
				</td>
			</tr>
			
			<tr>
				<td>
					<h3>Due Date</h3>
					<?php echo $due_date; ?>
				</td>

				<td>
					<h3>Due Time</h3>
					<?php echo $due_time; ?>
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<h3>Description</h3>
					<?php echo $description; ?>
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<a href="/tasks/update-task/?task_id=<?php echo $task_id; ?>">
						<button class="swingg-button" style="width: 100%;">Edit This Task</button>
					</a>
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<a href="/tasks/delete-task/?task_id=<?php echo $task_id; ?>">
						<button class="swingg-button" style="width: 100%;">Delete</button>
					</a>
				</td>
			</tr>
		</table>
	</div>
	<br>
	<br>
	<br>
		
<?php
	// If some how user by-passed the not login redirect
	else:
?>

<?php
	// Default not signed in code
	include_once $_SERVER['DOCUMENT_ROOT'].'/common/default-code/not-signed-in.php';
?>

<?php
	endif;
?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/bottom.php'; ?>