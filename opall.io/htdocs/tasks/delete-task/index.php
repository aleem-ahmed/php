<!-- [DELETE] Task Page -->
<?php
	/*** [INCLUDE SESSION -> NAME PAGE] Initialization file (Session and DB connection) ***/
	include_once $_SERVER['DOCUMENT_ROOT'].'/private/common/initialization.php';
	$page_title = "? Delete Task: "
?>

<?php	
	/*** [INCLUDE] DEFAULT FUNCTIONS ***/
	include_once $_SERVER['DOCUMENT_ROOT'].'/common/functions/functions.php';
?>

<?php
	/*** Include script to delete the task ***/
	include_once 'delete-task-script.php';
	$page_title .= $task_id;
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/top.php'; ?>

<span>
	<?php echo $user_id_error; ?><br>
	<?php echo $user_tasks_id_error; ?><br>
	<?php echo $task_id_error; ?><br>
	<?php echo $task_ownership_error; ?><br>
<span>

<form id="delete-prompt" action="<?php echo htmlspecialchars(($_SERVER["PHP_SELF"]) . '?task_id=' . $task_id); ?>" method="post">
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
<br>
<br>
<br>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/common/bottom.php'; ?>