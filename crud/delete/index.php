<!----- DELETE DATA PAGE ----->
<!-- TOP -->
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/crud/common/top.php'; ?>

<!-- SCRIPT -->
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/crud/delete/delete-data.php'; ?>

<!-- TITLE -->
<h1>Delete Data: <?php if (isset($data_id)) echo $data_id; ?></h1>
<br>

<form id="delete-prompt" action="<?php echo htmlspecialchars(($_SERVER["PHP_SELF"]) . '?data_id=' . $data_id); ?>" method="post">
	<table style="width: 500px;">
		<tr>
			<th colspan="2">Do You Really Want to Delete This Task?</th>
		</tr>
	
		<tr>
			<td style="width: 50%;">
				<button type="submit" name="deletion-decision" value="yes" class="swingg-button" style="width: 100%; margin: 20px 0;">Yes</button>
			</td>

			<td style="width: 50%;">
				<button type="submit" name="deletion-decision" value="no" class="swingg-button" style="width: 100%; margin: 20px 0;">No</button>
			</td>
		</tr>
	</table>
</form>

<!-- ERRORS -->
<span><?php echo $authorized_error; ?></span>
<span><?php echo $data_id_error; ?></span>


<?php include_once $_SERVER['DOCUMENT_ROOT'].'/crud/common/bottom.php'; ?>