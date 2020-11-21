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
		<!-- TOP NAV BAR -->
		<nav class="navbar navbar-dark black sticky-top flex-md-nowrap p-0" style="background-color: black;">
			<a href="/" class="navbar-brand col-sm-3 col-md-2 mr-0">
				<div class="title-container" style="margin: 0; padding: 5px;">
					<h1 class="title-logo" style="margin: 0; text-align: center; font-weight: 100; font-size: 1em;">opall.io</h1>		
				</div>
			</a>

			<!-- TOP-MIDDLE BUTTONS -->
			<div>
				<!-- Home Button -->
				<a href="/">
					<button class="btn btn-outline-secondary">
						<svg
							xmlns="http://www.w3.org/2000/svg"
							width="24"
							height="24"
							viewBox="0 0 24 24"
							fill="none"
							stroke="currentColor"
							stroke-width="2"
							stroke-linecap="round"
							stroke-linejoin="round"
							class="feather-2 feather-home"
						>
							<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
							<polyline points="9 22 9 12 15 12 15 22"></polyline>
						</svg>
					</button>
				</a>

				<!-- Contacts Button -->
				<a href="/contacts">
					<button class="btn btn-outline-secondary">
						<svg
							xmlns="http://www.w3.org/2000/svg"
							width="24"
							height="24"
							viewBox="0 0 24 24"
							fill="none"
							stroke="currentColor"
							stroke-width="2"
							stroke-linecap="round"
							stroke-linejoin="round"
							class="feather-2 feather-users"
						>
							<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
							<circle cx="9" cy="7" r="4"></circle>
							<path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
							<path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
						</svg>
					</button>
				</a>

				<!-- Chat Button -->
				<a href="/contacts/chat">
					<button class="btn btn-outline-secondary">
						<svg
							xmlns="http://www.w3.org/2000/svg"
							width="24"
							height="24"
							viewBox="0 0 24 24"
							fill="none"
							stroke="currentColor"
							stroke-width="2"
							stroke-linecap="round"
							stroke-linejoin="round"
							class="feather-2 feather-message-square"
						>
							<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
						</svg>
					</button>
				</a>

				<!-- Notifications Button -->
				<a href="/">
					<button class="btn btn-outline-secondary">
						<svg
							xmlns="http://www.w3.org/2000/svg"
							width="24"
							height="24"
							viewBox="0 0 24 24"
							fill="none"
							stroke="currentColor"
							stroke-width="2"
							stroke-linecap="round"
							stroke-linejoin="round"
							class="feather-2 feather-bell"
						>
							<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
							<path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
						</svg>
					</button>
				</a>
			</div>
			
			<!-- SIDE MENU BUTTON -->
			<ul class="navbar-nav" style="width: 16.66%;">
				<li>
					<button href="javascript:void(0)" onclick="openNav()" class="btn btn-outline-secondary"
						style="width: 100%; height: 48px; border-radius: 0%; font-size: 1.7em;">☰</button>
				</li>
			</ul>
		</nav>
		
		<!-- UNIVERSAL CONTAINER -->
		<div class="container-fluid">
			<div class="row">
				<div class="main-content">