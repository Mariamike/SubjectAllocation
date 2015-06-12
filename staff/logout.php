<?php 
	session_start();
	$_SESSION['loginid'] = 'null';

	header('location: ../');
?>