<!-- [Read All] Tasks Page -->
<?php
	// Include the initialization file (Session and DB connection) and Name the page
	include_once $_SERVER['DOCUMENT_ROOT'].'/private/common/initialization.php';
	$page_title = 'Your Tasks';
?>

<?php 
	// NOT Logged in -> Redirect
	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
		header('location: /login');
		exit;
	}
?>

<?php 
	// Include script to read-all tasks
	include 'read-all-tasks-script.php';
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/top.php'; ?>

<?php
	// if the user is signed in display:
	if (isset($_SESSION['username'])):
?>

	<h3 style="text-align: center;">Your Tasks</h3>
	
	<span><?php echo $user_id_error; ?></span><br>
	<span><?php echo $user_tasks_id_error; ?></span>

	<div style="overflow-x: auto;">
		<table class="table table-striped table-bordered">
			<tr>
				<th>Type</th>
				<th>Name</th>
				<th style="width: 120px;">Due Date</th>
				<th style="width: 101px;">Due Time</th>
			</tr>
			
			<?php echo $table_rows; ?>

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