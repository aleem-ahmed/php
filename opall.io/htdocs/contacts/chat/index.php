<!-- Chat Page -->
<?php
	// Include the initialization file (Session and DB connection) and Name the page
	include_once $_SERVER['DOCUMENT_ROOT'].'/private/common/initialization.php';
	$page_title = 'Chat with..';
?>

<?php 
	// NOT Logged in -> Redirect
	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
		header('location: /login');
		exit;
	}
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/top.php'; ?>

	<style>
		/* For This page only remove padding when screen 5/4 */
		header { display: none; }
		footer { display: none; }
	</style>

	<script>
		// AUTOMATIC SCROLL BOTTOM
		$(document).ready(function() {
			$('#chat-scroll').animate({
				scrollTop: $('#chat-scroll').get(0).scrollHeight
			}, 2000);
		});
	</script>

	<div class="contacts-chat">
		<!-- Contact info and title -->
		<div class="contacts-chat-title">
			<img src="/images/profilepic.png">
			<a href="" class="contacts-title-username">DaHomie72</a>
		</div>
		
		<!-- Chat Text Window -->
		<div id="chat-scroll" class="contacts-chat-box">

			<?php include_once 'chat-script.php'; ?>
			
			<p style="float: right; width: 100%; text-align: right;">Read 9:00 PM</p><br>
		</div>

		<!-- Chat Text box -->
		<form action="" class="contacts-chat-form">
			<input type="text" class="contacts-chat-text-box" style="background-color: #101010;" placeholder="Send Message">
			<button class="contacts-chat-send-button">Send</button>
		</form>
	
	</div>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/bottom.php'; ?>

