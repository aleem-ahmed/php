<div class="nav-drawer-menu" id="mySidenav" style="z-index: 1040;">
	<a href="javascript:void(0)" onclick="closeNav()" id="close-btn" style="margin: 0;">[ X ] CLOSE</a>
	<a href="/">Home</a>

<?php	
	/* Is the user already signed in? */
	if (isset($_SESSION['username'])):
?>

	<a href="/tasks">View Tasks</a>
	<a href="/your-account">Your Account</a>
	<a href="/your-profile">Your Profile</a>
	<a href="/logout.php" id="bottom-btn">Log Out</a>
	

<?php
	else:
?>

	<a href="/login">Login</a>
	<a href="/signup">Signup</a>

<?php
	endif;
?>

</div>

<!-- Invisible Side Nav button-->
<a href="javascript:void(0)" onclick="closeNav()">
	<div class="nav-drawer-menu-invisible-close" id="invisible-mySidenav"></div>
</a>