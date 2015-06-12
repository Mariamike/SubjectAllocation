<?php 
	include('../../connect.php');

	$id = $_POST['id'];
	$staff = $_POST['staff'];
	
	mysql_query("UPDATE allotment SET staffid=$staff, flag=1 WHERE allotid=$id");
	$result = mysql_query("SELECT name FROM staff WHERE staffid=$id");
	if($staff = mysql_fetch_array($result)){
		echo $staff['name'];
	}
?>