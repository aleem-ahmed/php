<!-- Login Page -->
<?php
	// Include the initialization file (Session and DB connection) and Name the page
	include_once $_SERVER['DOCUMENT_ROOT'].'/private/common/initialization.php';
	$page_title = 'Log In';
?>

<?php
	// Check if the user is already logged in, if yes then redirect him to welcome page
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
		header('location: /your-account');
		exit();
	}
?>

<?php
	// Include code to create user
	include_once 'user-login.php'; 
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/top.php'; ?>

<?php	
	/* Is the user already signed in? */
	if (isset($_SESSION['username'])):
?>

	<span>You are already logged in!</span>

<?php
	else:
?>
	
	<!-- Form -->
	<form 
		action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
		method="post"
		style="max-width: 300px; margin: 50px auto;"
	>
		<h1 style="text-align: center;">Log In</h1>
		<br>

		<!-- Email or Username -->
		<input
			name="username"
			type="text"
			class="form-control"
			placeholder="Username"
			aria-label="Type your username."
			autocomplete="no"
		/>
		<span id="username-error"><?php echo $username_error; ?></span>
		<br>
	
		<!-- Create Password -->
		<input
			name="password"
			type="password"
			class="form-control"
			placeholder="Password"
			minlength="8"
			aria-label="Type your password."
			autocomplete="no"
		/>
		<span id="password-error"><?php echo $password_error; ?></span>
		<br>
		<br>
		<br>

		<!-- Submit Button -->
		<button type="submit" class="btn btn-primary" style="width: 100%;">Log In</button>

		<span id="form-error" class="error error-message form-error-message"></span>
		<span id="form-message" class="form-message"></span>
		
		<input type="hidden" id="user-verb" name="user-verb" value="sign-up-user">
		<input type="hidden" id="token" name="token" value="<?php echo $_SESSION['token']; ?>">
	</form>

<?php
	endif;
?>

<!--- Custom Bottom ----------------------------------------------------------------------------------->
				</div>
			</div>
		</div>
	</body>
</html>

<?php
	// Navigation Items //
	include_once $_SERVER['DOCUMENT_ROOT'].'/common/nav/nav-drawer-menu.php';
?>