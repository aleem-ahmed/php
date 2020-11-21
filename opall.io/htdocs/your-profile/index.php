<!-- Friends Page -->
<?php
	// Include the initialization file (Session and DB connection) and Name the page
	include_once $_SERVER['DOCUMENT_ROOT'].'/private/common/initialization.php';
	$page_title = 'Your Profile';
?>

<?php 
	// NOT Logged in -> Redirect
	if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
		header("location: /login");
		exit;
	}
?>

<?php include 'get-profile-data-script.php'; ?>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/top.php'; ?>

	<h1>Your Profile</h1>
	<br>

	<table>
		<tr>
			<th style="width: 15%;"><?php echo $username; ?></th>
		</tr>
		<tr>
			<td>
				<a href="/your-profile/edit-profile">
					<img src="<?php echo $pic_url; ?>" class="your-profile-profile-img" alt="no profile pic">
				</a>
			</td>

			<td rowspan="2">
				<p>Description:</p>
				<br>
				<?php echo $description; ?>
			</td>
		</tr>
		<tr>
			<td>
				<a href="/contacts/">
					<button class="your-profile-view-contacts">View your Contacts</button>
				</a>
			</td>
		</tr>
	</table>
	<br>
	
	<a href="/your-profile/edit-profile">Edit Profile</a>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/bottom.php'; ?>