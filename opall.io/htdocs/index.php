<!-- 	Dashboard Page -->
<?php
	// [INITIALIZATION] Session & DB Con. // Name of Page //
	include_once '/srv/data/web/vhosts/www.opall.io/private/common/initialization.php';
	if (isset($_SESSION['username'])) { $page_title = 'Dashboard'; } else { $page_title = 'Welcome'; }
?>

<?php
	// [USER SIGNED IN] Display.. //
	if (isset($_SESSION['username'])):
?>

	<?php 
		// [SCRIPT] Read All Tasks //
		include 'tasks/read-all-tasks-script.php';
	?>

	<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/top.php'; ?>

	<!-- TAB SYSTEM -->
	<nav>
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
				aria-controls="nav-home" aria-selected="true">Personal Tasks</a>
			<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
				aria-controls="nav-profile" aria-selected="false">Project 1</a>
			<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
				aria-controls="nav-contact" aria-selected="false">Project 2</a>
		</div>
	</nav>

	<!-- Tab Content -->
	<div
		class="tab-content"
		style="
			padding: 15px;
			background-color: white;
			border-style: solid;
			border-width: 0 1px 1px 1px;
			border-color: #dee2e6;
		"
		id="nav-tabContent"
	>
		<!-- Personal Tasks Tab -->
		<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
			<span><?php echo $user_id_error = 'user id error here'; ?></span><br>
			<span><?php echo $user_tasks_id_error = 'user tasks id error here'; ?></span>

			<div style="overflow-x: auto;">
				<table class="table table-striped table-bordered">
					<tr>
						<th>Type</th>
						<th>Name</th>
						<th style="width: 120px;">Due Date</th>
						<th style="width: 101px;">Due Time</th>
					</tr>
					
					<?php echo $table_rows; ?>

				</table>
			</div>
		</div>

		<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
			At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
			deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
			provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum
			fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis
			est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis
			voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis
			aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.
			Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias
			consequatur aut perferendis doloribus asperiores repellat.
		</div>

		<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
			At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
			deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
			provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum
			fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis
			est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis
			voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis
			aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.
			Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias
			consequatur aut perferendis doloribus asperiores repellat.
		</div>
	</div>

	<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/bottom.php'; ?>

<?php 
	else:
?>
	
	<?php
		// [FRONT PAGE] //
		include_once 'front-page/front-page.php';
	?>

<?php 
	endif;
?>