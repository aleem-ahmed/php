<!-- [UPDATE] Task page -->
<?php
	// [INCLUDE SESSION -> NAME PAGE] Initialization file (Session and DB connection)
	include_once $_SERVER['DOCUMENT_ROOT'].'/private/common/initialization.php';
	$page_title = 'Edit Task: ';
?>

<?php 
	// [NOT LOGGED REDIRECTOR]
	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
		header('location: /login');
		exit;
	}
?>

<?php
	// [INCLUDE SCRIPT -> SET TASK_ID -> UPDATE PAGE NAME] 
	include_once 'update-task-data-script.php';
	if (!isset($task_id)) { $task_id = ''; }
	$page_title .= $task_id;
	
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

	<form action="<?php echo htmlspecialchars(($_SERVER["PHP_SELF"]) . "?task_id=$task_id"); ?>" method="post">
		<!-- (HIDDEN) Task Id and Errors -->
		<input type="hidden" name="task_id" value="<?php echo $_GET['task_id']; ?>">

		<table style="max-width: 500px;">
			<!-- Title -->
			<tr>
				<th colspan="2">Edit Task: <?php echo $task_id; ?></th>
			</tr>
			
			<!-- Type & Name -->
			<tr>
				<td colspan="2">
					<h3>Type</h3>
					<input type="text" name="type" class="swingg-input" style="width: 100%;" placeholder="Type" value="<?php echo $type; ?>">
					<br>
					<span><?php echo $type_error; ?></span>
					<br>

					<h3>Task Name</h3>
					<input type="text" name="name" class="swingg-input" style="width: 100%;" placeholder="Task Name" value="<?php echo $name; ?>">
					<br>
					<span><?php echo $name_error; ?></span>
					<br>
				</td>
			</tr>

			<!-- Due Date & Time -->
			<tr>
				<td>
					<h3>Due Date</h3>
					<input type="date" name="due_date" class="swingg-input" value="<?php echo $due_date; ?>">
					<br>
					<span><?php echo $due_date_error; ?></span>
					<br>
				</td>
				<td>
					<h3>Due Time</h3>
					<input type="time" name="due_time" class="swingg-input" value="<?php echo $due_time; ?>">
					<br>
					<span><?php echo $due_time_error; ?></span>
					<br>
				</td>
			</tr>

			<!-- Description -->
			<tr>
				<td colspan="2">
					<h3>Description</h3>
					<textarea id="note-content" rows="10" cols="60" name="description" class="swingg-textarea" style="resize: none; width: 100%;"><?php echo $description; ?></textarea>
					<br>
					<span><?php echo $description_error; ?></span>
					<br>
				</td>
			</tr>

			<!-- Submit -->
			<tr>
				<td colspan="2">
					<button type="submit" class="swingg-button" style="width: 100%">Edit Task</button>
				</td>
			</tr>
		</table>
	</form>
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