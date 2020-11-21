<!-- Friends Page -->
<?php
	// Include the initialization file (Session and DB connection) and Name the page
	include_once $_SERVER['DOCUMENT_ROOT'].'/private/common/initialization.php';
	$page_title = 'Search & Add Contacts';
?>

<?php 
	// Check if the user is logged in, if not then redirect him to login page
	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
		header('location: /login');
		exit;
	}
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/top.php'; ?>

<form action="<?php ?>"></form>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/bottom.php'; ?>