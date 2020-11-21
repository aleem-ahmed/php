
<!----- READ DATA PAGE ----->
<!-- TOP -->
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/crud/common/top.php'; ?>

<!-- SCRIPT -->
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/crud/read/read-data.php'; ?>

<!-- TITLE -->
<h1>Read Single Data</h1>

<!-- DISPALY STATS (If exists) -->
<h5 style="color: green;"><?php if (isset($_GET['status'])) { echo $_GET['status']; } ?></h5>
<br>

<!-- TABLE TO DISPLAY DATA -->
<table class="table table-striped table-bordered" style="width: 100%;">
	<tr>
		<th>Data Id</th>
		<th>Data 1</th>
		<th>Data 2</th>
		<th>Data 3</th>
		<th>Update</th>
		<th>Delete</th>
	</tr>

	<?php echo $table_row; ?>

</table>

<!-- ERRORS -->
<span><?php echo $authorized_error; ?></span>
<span><?php echo $data_id_error; ?></span>
<br>

<!-- CREATE NEW DATA BUTTON-->
<a href="/crud/create/"><button class="btn btn-secondary">Create Data</button></a>
<br>
<br>

<!-- BOTTOM -->
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/crud/common/bottom.php'; ?>