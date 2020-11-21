<!-- View Events Page -->
<?php
	// Include the initialization file (Session and DB connection) and Name the page
	include_once $_SERVER['DOCUMENT_ROOT'].'/private/common/initialization.php';
	$page_title = 'Your Schedule';
?>

<?php 
	include 'read-all-events-script.php';
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/top.php'; ?>

	<h1>Your Schedule</h1>
	<br>

	<div style="overflow-x: auto;">
		<table class="table table-striped table-bordered">
			<tr>
				<th>Name</th>
				<th>Type</th>
				<th>Days</th>
				<th>Time Start</th>
				<th>Time End</th>
				<th>Period Start</th>
				<th>Period End</th>
			</tr>
			
			<?php echo $table_rows; ?>

		</table>
	</div>
	<br>

	<span><?php echo $user_id_error; ?></span>
	<br>
	<span><?php echo $user_events_id_error;?></span>
	<br>
	<br>

	<a href="/"><button class="swingg-button">Home</button></a>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/bottom.php'; ?>