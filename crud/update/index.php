<!----- UPDATE DATA PAGE ----->
<!-- TOP -->
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/crud/common/top.php'; ?>

<!-- SCRIPT -->
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/crud/update/update-data.php'; ?>

<!-- TITLE -->
<h1>Update Data: <?php if (isset($data_id)) echo $data_id; ?></h1>
<br>

<!-- INPUTS -->
<form action="<?php echo htmlspecialchars(($_SERVER["PHP_SELF"]) . "?data_id=$data_id"); ?>" method="post">
	<h5 class="card-title">Data 1</h5>
	<input type="text" name="data1" value="<?php echo $data1; ?>" placeholder="(4 < Length < 50)">
	<br>
	<span><?php echo $data1_error; ?></span>
	<br>

	<h5 class="card-title">Data 2</h5>
	<input type="text" name="data2" value="<?php echo $data2; ?>" placeholder="(4 < Length < 50)">
	<br>
	<span><?php echo $data2_error; ?></span>
	<br>

	<h5 class="card-title">Data 3</h5>
	<input type="text" name="data3" value="<?php echo $data3; ?>" placeholder="(4 < Length < 50)">
	<br>
	<span><?php echo $data3_error; ?></span>
	<br>
	
	<button type="submit" class="btn btn-primary">Update Data</button>
</form>

<!-- ERRORS -->
<span><?php echo $authorized_error; ?></span>
<span><?php echo $data_id_error; ?></span>

<!-- BOTTOM -->
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/crud/common/bottom.php'; ?>