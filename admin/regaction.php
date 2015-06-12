<?php 
	require_once '../connect.php';

	$loginid = $_GET['id'];
	$action = $_GET['action'];

	if($action == 1){
		$query = "UPDATE login SET status=1 WHERE loginid=$loginid";
		mysql_query($query);
		$result = "Accepted";
	}
	else{
		$query = "DELETE FROM login WHERE loginid=$loginid";
		mysql_query($query);
		$query = "DELETE FROM staff WHERE loginid=$loginid";
		mysql_query($query);
		$result = "Rejected";
	}
?>
<script type="text/javascript">
	alert("<?php echo $result ?>");
	window.location.href="index.php";
</script>