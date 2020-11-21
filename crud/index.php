<!----- [READ ALL] DATA PAGE (HOME) ----->
<!-- TOP -->
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/crud/common/top.php'; ?>

<!-- SCRIPT -->
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/crud/read-all-data.php'; ?>

<h1>Reading All Data in Database</h1>
<!-- DATA ACTION STATUS (Get from the URL after redirect) -->
<h5 style="color: green;"><?php if (isset($_GET['status'])) { echo $_GET['status']; } ?></h5>
<br>

<!-- DISPLAY ALL THE DATA -->
<table class="table table-striped table-bordered" style="width: 100%;">
	<tr>
		<th>Data Id</th>
		<th>Data 1</th>
		<th>Data 2</th>
		<th>Data 3</th>
		<th>Read</th>
		<th>Update</th>
		<th>Delete</th>
	</tr>

	<?php echo $table_rows; ?>

</table>

<!-- ERRORS -->
<span><?php echo $error; ?></span>
<br>

<!-- CREATE DATA BUTTON -->
<a href="/crud/create/"><button class="btn btn-primary">Create New Data</button></a>
<br>
<br>

<!-- BOTTOM -->
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/crud/common/bottom.php'; ?>