<!-- [READ] event Page -->
<?php
	// [INCLUDE SESSION -> NAME PAGE] Initialization file (Session and DB connection)
	include_once $_SERVER['DOCUMENT_ROOT'].'/private/common/initialization.php';
	$page_title = 'Read event: ';
?>

<?php 
	// [NOT LOGGED REDIRECTOR]
	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
		//header('location: /login');
		//exit;
	}
?>

<?php
	// [INCLUDE SCRIPT -> UPDATE PAGE NAME] 
	include_once 'read-event-script.php';
	if (!isset($event_id)) { $event_id = ''; }
	$page_title =  $page_title .= $event_id;
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/top.php'; ?>

<?php
	// if the user is signed in display:
	if (isset($_SESSION['username'])):
?>

	<!-- Display Errors -->
	<span><?php echo $user_id_error; ?></span><br>
	<span><?php echo $user_events_id_error; ?></span><br>
	<span><?php echo $event_id_error; ?></span><br>
	<span><?php echo $event_ownership_error; ?></span><br>

	<div style="overflow-x: auto;">
		<table style="max-width: 300px;">
			<tr>
				<th>Event Details</th>
				<th>ID: <?php echo $event_id; ?></th>
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
				<td colspan="2">
					<h3>Days</h3>
					<p><?php echo $days; ?></p>
				</td>
			</tr>
			<tr>
				<td>
					<h3>Time Start</h3>
					<?php echo $time_start; ?>
				</td>

				<td>
					<h3>Time End</h3>
					<?php echo $time_end; ?>
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<h3>Repeating</h3>
					<?php if ($repeating == 1) { echo 'Yes'; } else { 'No'; } ?>
				</td>
			</tr>

			<tr>
				<td>
					<h3>Period Start</h3>
					<?php echo $period_start; ?>
				</td>

				<td>
					<h3>Period End</h3>
					<?php echo $period_end; ?>
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
					<a href="/events/update-event/?event_id=<?php echo $event_id; ?>">
						<button class="swingg-button" style="width: 100%;">Edit This event</button>
					</a>
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<a href="/events/read-event/delete-event/?event_id=<?php echo $event_id; ?>">
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