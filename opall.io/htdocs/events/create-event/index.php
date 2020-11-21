<!-- [CREATE] Event Page -->
<?php
	// Include the initialization file (Session and DB connection) and Name the page
	include_once $_SERVER['DOCUMENT_ROOT'].'/private/common/initialization.php';
	$page_title = 'Enter Schedule';
?>

<?php
	// Include code to create event
	include_once 'create-event-script.php';
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/top.php'; ?>

<?php
	// if the user is signed in display:
	if (isset($_SESSION['username'])):
?>

	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<!-- User ID (Hidden) -->
		<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

		<table style="max-width: 500px;">	
			<tr>
				<th colspan="2">Creat a Schedule Event</th>
			</tr>

			<!-- Type -->
			<tr>
				<td colspan="2">
					<h3>Type</h3>
					<input type="text" name="type" value="<?php echo $type; ?>" class="swingg-input" style="width: 100%;" placeholder="Type">
					<br>
					<span><?php echo $type_error; ?></span>
					<br>
				</td>
			</tr>

			<!-- Name -->
			<tr>
				<td colspan="2">
					<h3>Event Name</h3>
					<input type="text" name="name" value="<?php echo $name; ?>" class="swingg-input" style="width: 100%;" placeholder="Event Name">
					<br>
					<span><?php echo $name_error; ?></span>
					<br>
				</td>
			</tr>
			
			<!-- Start Time & End Time -->
			<tr>
				<td>
					<h3 style="margin-bottom: 0px;">Start Time</h3>
					<input type="time" value="<?php echo $time_start; ?>" class="swingg-input" name="time_start">
					<br>
					<span><?php echo $time_start_error; ?></span>
					<br>
				</td>
				<td>
					<h3 style="margin-bottom: 0px;">End Time</h3>
					<input type="time" value="<?php echo $time_end; ?>" class="swingg-input" name="time_end">
					<br>
					<span><?php echo $time_end_error; ?></span>
					<br>
				</td>
			</tr>
			
			<!-- Due Date & Time -->
			<tr>
				<td colspan="2">
					<h3 style="margin-bottom: 0px;">Day(s)</h3>
					<br>

					<div>
						<input type="checkbox"  name="mon" id="day" value="mon" <?php echo $mon_val; ?>>
						<label>Monday</label>
						<br>

						<input type="checkbox"  name="tue" id="day" value="tue" <?php echo $tue_val; ?>>
						<label>Tuesday</label>
						<br>

						<input type="checkbox"  name="wed" id="day" value="wed" <?php echo $wed_val; ?>>
						<label>Wednesday</label>
						<br>

						<input type="checkbox"  name="thu" id="day" value="thu" <?php echo $thu_val; ?>>
						<label>Thursday</label>
						<br>

						<input type="checkbox"  name="fri" id="day" value="fri" <?php echo $fri_val; ?>>
						<label>Friday</label>
						<br>

						<input type="checkbox"  name="sat" id="day" value="sat" <?php echo $sat_val; ?>>
						<label>Saturday</label>
						<br>

						<input type="checkbox"  name="sun" id="day" value="sun" <?php echo $sun_val; ?>>
						<label>Sunday</label>
						<br>
					</div>
					<span><?php echo $days_error; ?></span>
					<br><br>
				</td>
			</tr>

			<!-- Repeating, Period Start, & Period End -->
			<tr>	
				<td>
					<input type="checkbox" name="repeating" value="repeating" <?php echo $repeating_val; ?>>
					<label style="text-align: center;">Repeating</label>
					<br>
					<span><?php echo $repeating_error; ?></span>
					<br><br>
				</td>

				<td>
					<h3 style="text-align: center;">Period Duration</h3>
					<br>

					<h3>start</h3>
					<input type="date" value="<?php echo $period_start; ?>" class="swingg-input" name="period_start">
					<br>
					<span><?php echo $period_start_error; ?></span>
					<br><br>

					<h3>End</h3>
					<input type="date" value="<?php echo $period_end; ?>" class="swingg-input" name="period_end">
					<br>
					<span><?php echo $period_start_error; ?></span>
					<br><br>
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
					<button type="submit" class="swingg-button" style="width: 100%">Enter Event</button>
					<span><?php echo $user_id_error; ?></span><br>
					<span><?php echo $user_events_id_error; ?></span>
				</td>
			</tr>
		</table>
	</form>
	<br><br><br>

<?php 
	else:
?>
	
	<p>You do not have an account to create a schedule for!</p>
	<br>
	<br>

<?php 
	endif;
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/bottom.php'; ?>