<!-- [Create] Task Page -->
<?php
	// [INCLUDE SESSION -> NAME PAGE] Initialization file (Session and DB connection)
	include_once $_SERVER['DOCUMENT_ROOT'].'/private/common/initialization.php';
	$page_title = 'Create Tasks';
?>

<?php 
	// [NOT LOGGED REDIRECTOR]
	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
		header('location: /login');
		exit;
	}
?>

<?php
	// [INCLUDE SCRIPT -> UPDATE PAGE NAME] 
	include_once 'create-task-script.php';
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/top.php'; ?>

<?php
	// if the user is signed in display:
	if (isset($_SESSION['username'])):
?>

	<form
		action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
		method="post"
		style="width: 100%; margin: auto;"
	>
		<h2 style="width: 100%; text-align: center;">Create Task</h2>
		<br>

		<!-- [INPUT] Type & Name -->	
		<h3>Type</h3>
		<input
			type="text"
			name="type"
			value="<?php echo $type; ?>"
			placeholder="Type"
			class="form-control"
			style="width: 100%;"
		>
		<br>
		<span><?php echo $type_error; ?></span>
		<br>

		<h3>Task Name</h3>
		<input
			type="text"
			name="name"
			value="<?php echo $name; ?>"
			placeholder="Task Name"
			class="form-control"
			style="width: 100%;"
		>
		<br>
		<span><?php echo $name_error; ?></span>
		<br>
		
		<!-- Due Date & Time -->
		<h3>Due Date</h3>
		<input
			type="date"
			name="due_date"
			value="<?php echo $due_date; ?>"
			class="form-control"
		>
		<br>
		<span><?php echo $due_date_error; ?></span>
		<br>
		
		<h3>Due Time</h3>
		<input
			type="time"
			name="due_time"
			value="<?php echo $due_time; ?>"
			class="form-control"
		>
		<br>
		<span><?php echo $due_time_error; ?></span>
		<br>
		
		<!-- Description -->
		<h3>Description</h3>
		<textarea
			id="note-content"
			rows="10"
			cols="60"
			name="description"
			class="form-control"
			style="resize: none; width: 100%;"
		>
			<?php echo $description; ?>
		</textarea>
		<br>
		<span><?php echo $description_error; ?></span>
		<br>
		
		<!-- Submit -->
		<button type="submit" class="btn btn-secondary" style="width: 100%">Create Task</button>
		
		<!-- Display Errors -->
		<section>
			<span>User ID Error:<?php echo $user_id_error; ?> </span>
			<br>
			<span>User Tasks ID Error:<?php echo $user_tasks_id_error; ?></span>
		</section>
	</form>
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