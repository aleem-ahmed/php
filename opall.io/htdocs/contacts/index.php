<!-- [Read All] Tasks Page -->
<?php
	// [INITIALIZATION] Session & DB Con. // Name of Page //
	include_once '/srv/data/web/vhosts/www.opall.io/private/common/initialization.php';
	$page_title = 'Your Tasks';
?>

<?php 
	// [USER SIGNED IN] Display.. //
	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
		header('location: /login');
		exit;
	}

	echo 'e1';
?>

<?php
	/*** [INCLUDE] Functions ***/
	include $_SERVER['DOCUMENT_ROOT'].'/common/functions/contact-functions.php';

	echo 'e2';

	include_once 'read-all-contacts.php';

	echo 'e3';
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/top.php'; ?>

<?php
	// if the user is signed in display:
	if (isset($_SESSION['username'])):
?>

	<h3 style="text-align: center;">Your Contacts</h3>
	
	<span><?php echo $user_id_error; ?></span><br>

	<div style="overflow-x: auto;">
		<table style="margin: 0; max-width: 500px;">
			<tr>
				<th>Contact Name</th>
			</tr>
			
			<?php echo $table_rows; ?>
		</table>
	</div>
	<br>

	<div>
		<form action="add-contact.php" method="get">
			<input 
				type="text"
				name="contact-username"
				class="swingg-input"
				style="width: 400px; padding: 10px;"
				placeholder="Search for contact to add.."
			>
			<!-- [HIDDEN INPUT] User Action -->
			<input type="hidden" name="add-contact">
			<button class="swingg-button" style="width: 90px; font-size: 1em;">Search</button>
		</form>
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