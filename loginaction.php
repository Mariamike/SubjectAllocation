<?php 

	require_once 'connect.php';
	session_start();

	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = "SELECT * FROM login WHERE username='$username' AND password='$password'";
	$result = mysql_query($query);

	if($data = mysql_fetch_array($result)){
		if($data['status'] == 1){
			$_SESSION['loginid'] = $data['loginid'];
			switch ($data['type']) {
				case 'admin':
					header('location:admin/');
					break;
				
				case 'staff':
					header('location:staff/');
					break;
				default:
					echo("<script>alert(\"Invalid User\"); window.location.href=\"login.php\";</script>");
					break;
			}
		}
		else{
			echo("<script>alert(\"You are not yet approved\"); window.location.href=\"login.php\";</script>");
		}
	}
	else{
		echo("<script>alert(\"Invalid username or password\"); window.location.href=\"login.php\";</script>");
	}
	
?>