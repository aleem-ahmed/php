<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- JQUERY CDN & BOOTSTRAP CSS AND JS CDN & JQuery-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

		<link
			href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
			crossorigin="anonymous"
		>
		<script
			src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
			integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm"
			crossorigin="anonymous"
		></script>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		
		<link rel="shortcut icon" type="image/x-icon" href="/images/swingg_logo.png" />
		<title><?php if (isset($page_title)) { echo $page_title; } else { echo 'No Title Set'; } ?></title>

		<!-- General CSS -->
		<link rel="stylesheet" type="text/css" href="/css/bootstrap-edits.css">
		<link rel="stylesheet" type="text/css" href="/css/elements.css">
		<link rel="stylesheet" type="text/css" href="/css/header-footer.css">
		<link rel="stylesheet" type="text/css" href="/css/nav.css">
		<link rel="stylesheet" type="text/css" href="/css/opall.css">
		<link rel="stylesheet" type="text/css" href="/css/side-bars.css">

		<!-- Individual Page (alphabetical) -->
		<link rel="stylesheet" type="text/css" href="/css/contacts.css">
		<link rel="stylesheet" type="text/css" href="/css/users.css">
		<link rel="stylesheet" type="text/css" href="/css/your-profile.css">

		<!-- Javascript -->
		<script src="/js/swingg.js"></script>
		<script src="/js/side-nav-menu.js"></script>
	</head>

	<body>
		<style>
			/* Container holding the image and the text */
			.front-page-container {
				position: relative;
				text-align: center;
				color: white;
			}

				/* Centered text */
			.centered {
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
			}
		</style>

		<div
			class="front-page-container"
			style="
				height: 100vh;
				background-image: url('https://source.unsplash.com/3840x2160/?mountain');
				background-size: cover;
			"
		>
			<div class="centered">
				<div
					class="title-container"
					style="
						margin: 20px auto;
						padding: 5px;width:
						200px;
						font-size: 3em;
						background: #ffffff61;
					"
				>
					<h1
						class="title-logo"
						style="
							margin: 0;
							text-align: center;
							font-weight: 100;
							font-size: 1em;
						"
					>opall.io</h1>		
				</div>
					
				<h1 style="width: 100%; text-align: center;">Your personal digital assistant!</h1>
				<br>
				<br>

				<h3 style="width: 100%; text-align: center;">Looking to sign up or log in? Great!</h3>
				<br>
				<br>
				<br>

				<section class="" style="width: 100%; text-align: center;">
					<a href="/login" class="btn btn-light" style="font-size: 1.5em;">Log In</a>
					<a href="/signup" class="btn btn-primary" style="font-size: 1.5em;">Sign Up</a>
				</section>
			</div>
		</div>

		<!-- Footer -->
		<footer class="page-footer font-small grey pt-4" style="background-color: #dee2e6;">
			<!-- Footer Links -->
			<div class="container-fluid text-center text-md-left">

				<!-- Grid row + column -->
				<div class="row">
					<div class="col-md-6 mt-md-0 mt-3">
						<h5 class="text-uppercase">Looking for something else?</h5>
						<p>Other resources.</div</p>
					</div>

					<hr class="clearfix w-100 d-md-none pb-3">

					<!-- Grid column + Links -->
					<div class="col-md-3 mb-md-0 mb-3">
						<h5 class="text-uppercase">Links</h5>
						<ul class="list-unstyled">
							<li><a href="#!">Link 1</a></li>
							<li><a href="#!">Link 2</a></li>
							<li><a href="#!">Link 3</a></li>
							<li><a href="#!">Link 4</a></li>
						</ul>
					</div>

					<!-- Grid column + Links -->
					<div class="col-md-3 mb-md-0 mb-3">
						<h5 class="text-uppercase">Links</h5>
						<ul class="list-unstyled">
							<li><a href="#!">Link 1</a></li>
							<li><a href="/about">About</a></li>
							<li><a href="/support">Support</a></li>
							<li><a href="/legal-disclaimer">Legal-Disclaimer</a></li>
						</ul>
					</div>
				</div>
			</div>

			<!-- Copyright -->
			<div class="footer-copyright text-center py-3">© 2020 Copyright:
				<a href="https://www.opall.io"> opall.io</a>
			</div>
		</footer>
	</body>
</html>