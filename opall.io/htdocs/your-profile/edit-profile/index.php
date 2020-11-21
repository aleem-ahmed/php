<!-- Friends Page -->
<?php
	// Include the initialization file (Session and DB connection) and Name the page
	include_once $_SERVER['DOCUMENT_ROOT'].'/private/common/initialization.php';
	$page_title = 'Edit Your Profile';
?>

<?php
	// NOT Logged in -> Redirect
	if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
		header("location: /login");
		exit;
	}
?>

<?php include 'edit-profile-script.php'; ?>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/top.php'; ?>

	<form action="" method="post">
		<!-- Pic URL -->
		<label for="edit_pic_url">Profile Image URL:</label>
		<br><br>

		<input name="edit_pic_url" type="text" class="swingg-input your-profile-input" value="<?php echo $edit_pic_url; ?>">
		<span><?php echo $edit_pic_url_error; ?></span>
		<br><br>

		<!-- Description -->
		<label for="edit_description">Your Profile Description:</label>
		<br><br>

		<textarea name="edit_description" type="text" class="your-profile-textarea" rows="10"><?php echo $edit_description; ?></textarea>
		<span><?php echo $edit_description_error; ?></span>
		<span><?php echo $sql_error; ?></span>
		<br><br>
		
		<!-- Submit Button -->
		<button type="submit" style="float: left;">Change Profile</button>
		<button onclick="window.location.href = '/your-profile'" style="float: right;" >Cancel</button>
	</form>
	<br>
	
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/bottom.php'; ?>