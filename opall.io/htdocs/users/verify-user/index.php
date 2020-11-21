<!-- User Verification Page -->
<?php
	// Include the initialization file (Session and DB connection) and Name the page
	include_once $_SERVER['DOCUMENT_ROOT'].'/private/common/initialization.php';
	$page_title = 'Verification';
?>

<?php
	// Include script to verify the user
	include_once 'verify_user.php';
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/top.php'; ?>

	<!-- Errors from verifaction proccess -->
	<h1><?php echo $verification_status; ?></h1>
	<span><?php echo $vkey_error; ?></span>
	<br>

	<span><?php echo $user_id_error; ?></span>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/bottom.php'; ?>