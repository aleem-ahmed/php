				</div>
			</div>
		</div>

<?php
	// If Logged in --> Show sidebars //
	if (isset($_SESSION['username'])):	
		include_once $_SERVER['DOCUMENT_ROOT'] . '/common/side-bars/left-sidebar.php';
		include_once $_SERVER['DOCUMENT_ROOT'] . '/common/side-bars/right-sidebar.php';
	endif;
?>

<?php	
	/* Is the user already signed in? */
	if (!isset($_SESSION['username'])):
?>

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

<?php
	endif;
?>

	</body>
</html>

<?php
	// Navigation Items //
	include_once $_SERVER['DOCUMENT_ROOT'].'/common/nav/nav-drawer-menu.php';
?>