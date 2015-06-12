
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>	
<head>
<title>SJCET SUBJECT ALLOCATOR</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<meta name="keywords" content="User Login Form Responsive Templates, Iphone Widget Template, Smartphone login forms,Login form, Widget Template, Responsive Templates, a Ipad 404 Templates, Flat Responsive Templates" />
<link href="css/loginstyle.css" rel='stylesheet' type='text/css' />
<!--web-fonts-->
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!--/web-fonts-->
<script src="js/jquery-1.11.0.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript">

	$(function() {
	    $( "#joining" ).datepicker({ dateFormat: 'dd-mm-yy' });
	  });
	function validate(){
		var valid = true;
		
		if ($("#password").val() !== $("#cpassword").val()) {
			$("#error").show();
			$("#password").css('border-color', '#f00');
			$("#cpassword").css('border-color', '#f00');
			valid = false;
		}
		else{
			$("#error").hide();
			$("#password").css('border-color', '#A8AEC5');
			$("#cpassword").css('border-color', '#A8AEC5');
		}

		var regex = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		if (!($("#email").val().match(regex))) {
			$("#error_email").show();
			$("#email").css('border-color', '#f00');
			valid = false;
		}
		else{
			$("#error_email").hide();
			$("#email").css('border-color', '#A8AEC5');
		}
		return valid;
	}
</script>
</head>
<body>
<div class="container">
	<div class="avtar-reg">
		<img src="images/avtar.png" />
	</div>
	<h1 class="h1-reg">Staff Registration</h1><br/><br/><br/><br/><br/><br/>

	<div class="reg-form">
		<form class="reg-form" method="post" action="regaction.php" onsubmit="return validate()">
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" id="name" name="name" required>
			</div>
			<div class="form-group">
				<label for="designation">Designation</label>
				<input type="text" id="designation" name="designation" required>
			</div>
			<div class="form-group">
				<label for="joining">Joining Year</label>
				<input type="text" id="joining" name="joining" required>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" id="email" name="email" required>
				<span id="error_email" class="error">* Invalid Email</span>
			</div>
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" id="username" name="username" required>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" id="password" name="password" required>
			</div>
			<div class="form-group">
				<label for="cpassword">Confirm Password</label>
				<input type="password" id="cpassword" name="cpassword" required>
				<span id="error" class="error">* Passwords doesn't match</span>
			</div>
			<input class="reg-submit" type="submit" value="Submit">
		</form>
	</div>

</div>

<br/><br/><br/>

<!--start-copyright-->
<div class="copy-right">
	<p>&copy <a href="index.php">sjcet 2015</a></p> 
</div>
<!--//end-copyright-->	
</body>
</html>
