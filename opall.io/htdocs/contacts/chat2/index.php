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

	<table>
		<tr>
			<td>
				<!-- Contact info and title -->
				<div class="contacts-chat-title">
					<img src="/images/profilepic.png" style="height:10px;">
					<a href="" class="contacts-title-username">DaHomie72</a>
				</div>
			</td>

			<td rowspan="3">
				<!-- Your Contacts -->
				<div class="contacts-yourcontacts">
					<h1>My contacts</h1>
				</div>
			</td>
		</tr>

		<tr>
			<td>
				<!-- Chat Text Window -->
				<div id="chat-scroll" class="contacts-chat-box" style="height: 300px;">
					<div class="contact-receive-container">
						<div class="contact-receive">
							YOOOO! Bro you wanna go get lit tonight?? We out to slate? Drinks on me!
						</div>
					</div>

					<div class="contact-send-container">
						<div class="contact-send">
							IDK man, i gotta do my project for my internet computing class..
						</div>	
					</div>

					<div class="contact-receive-container">
						<div class="contact-receive">
							Dude that is so lame... Hows that cool project going? the one with the planning and stuff?
						</div>
					</div>

					<div class="contact-send-container">
						<div class="contact-send">
							Fustrated but not giving up!!
						</div>	
					</div>

					<div class="contact-receive-container">
						<div class="contact-receive">
							cool if you want any help just let me know! ill check my shedule to see if i got time or u can just use swingg to automaticly check when we both have available time to collaborate
						</div>
					</div>

					<div class="contact-send-container">
						<div class="contact-send">
							LIT. If i have time lets go get some food!
						</div>	
					</div>

					<div class="contact-send-container">
						<div class="contact-send">
							also dont forget that we gotta do that thing that the boss wanted done. make sure you take em out.
						</div>
					</div>
					<p style="float: right; width: 100%; text-align: right;">Read 9:00 PM</p><br>

				</div>
			</td>
		</tr>
		<tr>
			<td>
				<!-- Chat Text box -->
				<form action="" class="contacts-chat-form">
					<input type="text" class="contacts-chat-text-box" style="background-color: #101010;" placeholder="Send Message">
					<button class="contacts-chat-send-button">Send</button>
				</form>
	
			</td>
		</tr>
		<tr>
			<td colspan="2"></td>
		</tr>
	</table>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/bottom.php'; ?>

