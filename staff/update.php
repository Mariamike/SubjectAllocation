<?php 
	require_once '../connect.php';

	$name = $_POST['name'];
	$designation = $_POST['designation'];
	$email = $_POST['email'];
	$doj = $_POST['doj'];

	mysql_query("UPDATE staff SET name='$name', designation='$designation', email='$email', joindate='$doj'");

	header('location: index.php');
?>