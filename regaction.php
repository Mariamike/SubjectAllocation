<?php 
	require_once 'connect.php';

	$name = $_POST['name'];
	$designation = $_POST['designation'];
	$joining = $_POST['joining'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = "INSERT INTO login (username, password, type, status) VALUES ('$username', '$password', 'staff', 0)";
	mysql_query($query);

	$query = "SELECT loginid FROM login WHERE username='$username' AND password='$password'";
	$result = mysql_query($query);
	$loginid = mysql_fetch_array($result);

	$query = "INSERT INTO staff (loginid, name, designation, email, joindate) VALUES (" . $loginid['loginid'] . ", '$name', '$designation', '$email', '$joining')";
	mysql_query($query);
?>
<script type="text/javascript">
	alert("Registration Successfull");
	window.location.href="index.php";
</script>