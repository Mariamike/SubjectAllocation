<?php 

require_once '../connect.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>SJCET SUBJECT ALLOCATOR</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Unicorn Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- bootstarp-css -->
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!--// bootstarp-css -->
	<!-- css -->
	<link rel="stylesheet" href="../css/style.css" type="text/css" media="all" />
	<!--// css -->
	<script src="../js/jquery-1.11.0.min.js"></script>
	<!--fonts-->
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
	<!--/fonts-->
	<!---- start-smoth-scrolling---->
	<script type="text/javascript" src="../js/move-top.js"></script>
	<script type="text/javascript" src="../js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});

			$("#edit_btn").click(function(){
				$("#edit_form input").removeAttr('disabled');
				$("#edit_submit").show();
				$(this).hide();
			});
		});
	</script>

	<script type="text/javascript">
		function getsubjects(ths, target){
			$.ajax({
			  url: "ajax/getsubject.php",
			  method: "POST",
			  data: { sem : ths.value }
			}).done(function( msg ) {
			  $( "#"+target ).html( msg );
			}).fail(function( jqXHR, textStatus ) {
			  alert( "Request failed: " + textStatus );
			});
		}

		function getlab(ths, target){
			$.ajax({
			  url: "ajax/getlab.php",
			  method: "POST",
			  data: { sem : ths.value }
			}).done(function( msg ) {
			  $( "#"+target ).html( msg );
			}).fail(function( jqXHR, textStatus ) {
			  alert( "Request failed: " + textStatus );
			});
		}
	</script>

	<style type="text/css">
		.cbp-spmenu-right.cbp-spmenu-open{
			width: 41%;
		}
		.cbp-spmenu-right{
			right: -500px;
		}
	</style>
	<!--start-smoth-scrolling-->
</head>
<body>
	<!-- banner -->
	<div class="banner" id="home">
		<!-- container -->
		<div class="container">
			<div class="header">
				<div class="head-logo">
					<a href="index.html"><img src="../images/logo.png" alt="" /></a>
				</div>
				<div class="header-info-right">
					<div class="header cbp-spmenu-push">
						<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
							<a class="scroll" href="index.html">HOME</a>
							<a class="scroll" href="#about">MY ALLOTMENTS</a>
							<a class="scroll" href="#profile">PROFILE</a>
							<a class="scroll" href="#stories">PREFERENCE FORM</a>
							<!-- <a class="scroll" href="#hello">HELLO</a> -->
							<a href="logout.php">LOGOUT</a>
						</nav>
						<!--script-nav -->	
						<script>
							$("span.menu").click(function(){
								$("ul.navigatoin").slideToggle("300" , function(){
								});
							});
						</script>
						<script type="text/javascript">
							jQuery(document).ready(function($) {
								$(".scroll").click(function(event){		
									event.preventDefault();
									$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
								});
							});
						</script>
						<div class="clearfix"> </div>
						<!-- /script-nav -->
						<div class="main">
							<section class="buttonset">
								<button id="showRightPush"><img src="../images/menu.png" /></button>
							</section>
						</div>
						<!-- Classie - class helper functions by @desandro https://github.com/desandro/classie -->
						<script src="../js/classie.js"></script>
						<script>
							var	menuRight = document.getElementById( 'cbp-spmenu-s2' ),
							showRightPush = document.getElementById( 'showRightPush' ),
							body = document.body;

							showRightPush.onclick = function() {
								classie.toggle( this, 'active' );
								classie.toggle( body, 'cbp-spmenu-push-toleft' );
								classie.toggle( menuRight, 'cbp-spmenu-open' );
								disableOther( 'showRightPush' );
							};
						</script>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<!-- //container -->
		<div class="container">
			<div class="banner-info">
				<h2>SJCET SUBJECT ALLOCATOR</h2>
				<span></span>
				<div class="personal-details">
					<?php 
						$query = "SELECT * FROM staff WHERE loginid=" . $_SESSION['loginid'];
						$result = mysql_query($query);
						$data = mysql_fetch_array($result);
						if(date('m') > 6){
							$Academic = date('Y') . " - " . date('Y', strtotime('+1 year'));
						}
						else{
							$Academic = date('Y', strtotime('-1 year')) . " - " . date('Y');
						}
					?>
					<label><?php echo $data['name'] ?></label><br/>
					<label><?php echo $data['designation'] ?></label><br/>
					<label><?php echo $Academic ?></label>
				</div>
				
			</div>
		</div>
	</div>
	<!--//banner-->
	<!--about-starts-->
	<div class="about" id="about">
		<div class="container">
			<div class="about-mian">
				<img src="../images/abt-1.png" alt=""/>
				<h3>My Allotments</h3>
				<table class="table table-hover table-left">
					<th>No</th>
					<th>Subject</th>
					<th>Semester</th>
					<tr>
						<td colspan="5" style="color: #f60">THEORY</td>
					</tr>
					<?php 
						$i = 1;
						$query = "SELECT sub FROM allotment WHERE staffid=" . $_SESSION['loginid'] . " ORDER by sub ASC";
						$result = mysql_query($query);

						$lab_subjects = array();
						$k = 0;
						while ($data = mysql_fetch_array($result)) {
							$query = "SELECT * FROM subjects WHERE subjectid = " . $data['sub'];
							$result2 = mysql_query($query);
							if ($subject = mysql_fetch_array($result2)) {
								$query = "SELECT semester FROM semester WHERE semesterid=" . $subject['semesterid'];
								$semresult = mysql_query($query);
								if ($semester = mysql_fetch_array($semresult)) {
									if ($subject['type'] == "LAB") {
										$lab_subjects[$k++] = array('subject' => $subject['subject'], 'semester' => $semester['semester']);
										continue;
									}
					?>
						<tr>
							<td><?php echo $i++ ?></td>
							<td><?php echo $subject['subject'] ?></td>
							<td><?php echo $semester['semester'] ?></td>
						</tr>
					<?php
								}
							}
						}
					?>
					<tr>
						<td colspan="5" style="color: #f60">LAB</td>
						<?php 

							foreach ($lab_subjects as $subject) {
						?>
						<tr>
							<td><?php echo $i++ ?></td>
							<td><?php echo $subject['subject'] ?></td>
							<td><?php echo $subject['semester'] ?></td>
						</tr>
						<?php
							}
						?>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<!--about-ends-->
	
	<div class="about" id="profile">
		<div class="container">
			<div class="about-mian">
				<img src="../images/abt-1.png" alt=""/>
				<h3>Profile</h3>
				<?php 
					$query = "SELECT * FROM staff WHERE loginid=" . $_SESSION['loginid'];
					$result = mysql_query($query);
					$data = mysql_fetch_array($result);
				?>
				<div class="col-md-6 col-md-offset-3">
					<form id="edit_form" role="form" class="form-horizontal" method="post" action="update.php">
						<div class="form-group">
							<label class="form-label col-md-6">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="<?php echo $data['name'] ?>" disabled>
							</div>
						</div>

						<div class="form-group">
							<label class="form-label col-md-6">Designation</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="designation" value="<?php echo $data['designation'] ?>" disabled>
							</div>
						</div>

						<div class="form-group">
							<label class="form-label col-md-6">Email</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="<?php echo $data['email'] ?>" disabled>
							</div>
						</div>

						<div class="form-group">
							<label class="form-label col-md-6">Date of Joining</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="doj" value="<?php echo $data['joindate'] ?>" disabled>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-6">
								<input type="submit" id="edit_submit" class="btn btn-info btn-block" value="Save">
							</div>
						</div>
					</form>	
					<div class="col-md-6 col-md-offset-6">
						<input id="edit_btn" type="button" class="btn btn-block btn-default" value="Edit">
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<!--portfolio-starts-->
	<div class="port" id="stories" style="height: 500px;">
		<div class="port-top">
			<h3>Preference Form</h3>
			<p>Here you can set your preference for subjects in the comming semester </p>
			<span></span>
		</div>

		<div class="col-md-10 col-md-offset-1 top-spacer-20">
			<div>
				<?php 
				if(date('m') > 6){
					$type = "EVEN";
				}
				else{
					$type = "ODD";
				}

				?>
				<h3>Theory</h3>
				<form method="post" action="preference.php">
					<input type="hidden" name="form" value="theory">
					<table class="table table-hover">
						<th></th>
						<th>Semester</th>
						<th>Subject</th>
						<th>Experience</th>
						<th>Pass Percentage</th>
						<th>Special Reasons</th>
						<tr>
							<td>Preferance 1</td>
							<td>
								<select id="pref1" name="prefsem1" onchange="getsubjects(pref1, 'sub1')">
									<option>select</option>
									<?php 
									$query = "SELECT * FROM semester WHERE type='$type'";
									$result = mysql_query($query);
									while ($data = mysql_fetch_array($result)) {
										?>

										<option value="<?php echo $data['semesterid'] ?>"><?php echo $data['semester'] ?></option>
										<?php
									}
									?>
									
								</select>
							</td>
							<td>
								<select id="sub1" name="prefsub1">
									<option value=""></option>
								</select>
							</td>
							<td>
								<input type="text" name="prefexp1" value="" placeholder="Experiance">
							</td>
							<td>
								<input type="text" name="prefgrade1" value="" placeholder="Grade">
							</td>
							<td>
								<input type="text" name="prefreason1" value="" placeholder="Special Reason">
							</td>
						</tr>
						<tr>
							<td>Preferance 2</td>
							<td>
								<select id="pref2" name="prefsem2" onchange="getsubjects(pref2, 'sub2')">
									<option>select</option>
									<?php 
									$query = "SELECT * FROM semester WHERE type='$type'";
									$result = mysql_query($query);
									while ($data = mysql_fetch_array($result)) {
										?>

										<option value="<?php echo $data['semesterid'] ?>"><?php echo $data['semester'] ?></option>
										<?php
									}
									?>
								</select>
							</td>
							<td>
								<select id="sub2" name="prefsub2">
									<option value=""></option>
								</select>
							</td>
							<td>
								<input type="text" name="prefexp2" value="" placeholder="Experiance">
							</td>
							<td>
								<input type="text" name="prefgrade2" value="" placeholder="Grade">
							</td>
							<td>
								<input type="text" name="prefreason2" value="" placeholder="Special Reason">
							</td>
						</tr>
						<tr>
							<td>Preferance 3</td>
							<td>
								<select id="pref3" name="prefsem3" onchange="getsubjects(pref3, 'sub3')">
									<option>select</option>
									<?php 
									$query = "SELECT * FROM semester WHERE type='$type'";
									$result = mysql_query($query);
									while ($data = mysql_fetch_array($result)) {
										?>

										<option value="<?php echo $data['semesterid'] ?>"><?php echo $data['semester'] ?></option>
										<?php
									}
									?>
								</select>
							</td>
							<td>
								<select id="sub3" name="prefsub3">
									<option value=""></option>
								</select>
							</td>
							<td>
								<input type="text" name="prefexp3" value="" placeholder="Experiance">
							</td>
							<td>
								<input type="text" name="prefgrade3" value="" placeholder="Grade">
							</td>
							<td>
								<input type="text" name="prefreason3" value="" placeholder="Special Reason">
							</td>
						</tr>
						<tr>
							<td>Preferance 4</td>
							<td>
								<select id="pref4" name="prefsem4" onchange="getsubjects(pref4, 'sub4')">
									<option>select</option>
									<?php 
									$query = "SELECT * FROM semester WHERE type='$type'";
									$result = mysql_query($query);
									while ($data = mysql_fetch_array($result)) {
										?>

										<option value="<?php echo $data['semesterid'] ?>"><?php echo $data['semester'] ?></option>
										<?php
									}
									?>
								</select>
							</td>
							<td>
								<select id="sub4" name="prefsub4">
									<option value=""></option>
								</select>
							</td>
							<td>
								<input type="text" name="prefexp4" value="" placeholder="Experiance">
							</td>
							<td>
								<input type="text" name="prefgrade4" value="" placeholder="Grade">
							</td>
							<td>
								<input type="text" name="prefreason4" value="" placeholder="Special Reason">
							</td>
						</tr>
					</table>
					<input class="btn btn-primary col-md-offset-10" type="submit" name="" value="Submit">
				</form>


				<h3>Lab</h3>
				<form method="post" action="preference.php">
					<input type="hidden" name="form" value="lab">
					<table class="table table-hover">
						<th></th>
						<th>Semester</th>
						<th>Subject</th>
						<th>Experience</th>
						<th>Pass Percentage</th>
						<th>Special Reasons</th>
						<tr>
							<td>Preferance 1</td>
							<td>
								<select id="lab1" name="prefsem1" onchange="getlab(lab1, 'labsub1')">
									<option>select</option>
									<?php 
									$query = "SELECT * FROM semester WHERE type='$type'";
									$result = mysql_query($query);
									while ($data = mysql_fetch_array($result)) {
										?>

										<option value="<?php echo $data['semesterid'] ?>"><?php echo $data['semester'] ?></option>
										<?php
									}
									?>
									
								</select>
							</td>
							<td>
								<select id="labsub1" name="prefsub1">
									<option value=""></option>
								</select>
							</td>
							<td>
								<input type="text" name="prefexp1" value="" placeholder="Experiance">
							</td>
							<td>
								<input type="text" name="prefgrade1" value="" placeholder="Grade">
							</td>
							<td>
								<input type="text" name="prefreason1" value="" placeholder="Special Reason">
							</td>
						</tr>
						<tr>
							<td>Preferance 2</td>
							<td>
								<select id="lab2" name="prefsem2" onchange="getlab(lab2, 'labsub2')">
									<option>select</option>
									<?php 
									$query = "SELECT * FROM semester WHERE type='$type'";
									$result = mysql_query($query);
									while ($data = mysql_fetch_array($result)) {
										?>

										<option value="<?php echo $data['semesterid'] ?>"><?php echo $data['semester'] ?></option>
										<?php
									}
									?>
								</select>
							</td>
							<td>
								<select id="labsub2" name="prefsub2">
									<option value=""></option>
								</select>
							</td>
							<td>
								<input type="text" name="prefexp2" value="" placeholder="Experiance">
							</td>
							<td>
								<input type="text" name="prefgrade2" value="" placeholder="Grade">
							</td>
							<td>
								<input type="text" name="prefreason2" value="" placeholder="Special Reason">
							</td>
						</tr>
					</table>
					<input class="btn btn-primary col-md-offset-10" type="submit" name="" value="Submit">
				</form>
			</div>
		</div>

	</div>
	<div class="quote">
		<div class="container">
			<div class="quote-main">
				<img src="../images/07.png" alt=""/>
				<p>A College With A Differrence</p>
			</div>
		</div>
	</div>
	</div>


	<!--portfolio-ends-->
	
	
	<!--footer-starts-->
<!--	<div class="footer" id="footer">
		<div class="container">
			<div class="footer-top">
				<div class="col-md-6 footer-left">
					<a href="index.html"><img src="../images/logo-1.png" alt=""/></a>
					<p>One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his</p>
					<div class="contact-text">
						<input type="text" value="EMAIL" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'EMAIL';}"/>
						<input type="text" value="SUBJECT" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'SUBJECT';}"/>
						<textarea value="MESSAGE" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'MESSAGE';}">MESSAGE</textarea>					
					</div>
					<div class="sub-button">
						<form>
							<input type="submit" value="SEND">
						</form>
					</div>
				</div>
				<div class="col-md-6 footer-right">
					<div class="col-md-4 footer-links">
						<h4>LINKS</h4>
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">About</a></li>
							<li><a href="#">Services</a></li>
							<li><a href="#">Menu</a></li>
							<li><a href="#">Restaurants</a></li>
							<li><a href="#">Work Hours</a></li>
							<li><a href="#">Call Hours</a></li>
						</ul>
					</div>
					<div class="col-md-4 footer-links">
						<h4>FRIENDS</h4>
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">About</a></li>
							<li><a href="#">Services</a></li>
							<li><a href="#">Menu</a></li>
							<li><a href="#">Restaurants</a></li>
						</ul>
					</div>
					<div class="col-md-4 footer-links">
						<h4>SOCIAL</h4>
						<ul>
							<li><a href="#">Facebook</a></li>
							<li><a href="#">Twitter</a></li>
							<li><a href="#">Github</a></li>
							<li><a href="#">Pinterest</a></li>
							<li><a href="#">Google Plus</a></li>
							<li><a href="#">Dribbble</a></li>
							<li><a href="#">Flickr</a></li>
							<li><a href="#">Others</a></li>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="footer-bottom">
				<div class="col-md-6 footer-bottom-left">
					<p>Template By <a href="http://w3layouts.com/">W3layouts</a></p>
				</div>
				<div class="col-md-6 footer-bottom-right">
					<ul>
						<li><p><a href="#">TERMS</a></p></li>
						<li><p><a href="#">PRIVACY POLICY</a></p></li>
						<li><p><a href="#footer">CONTACT</a></p></li>
						<li><p><a href="#">JOB</a></p></li>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function() {
										/*
										var defaults = {
								  			containerID: 'toTop', // fading element id
											containerHoverID: 'toTopHover', // fading element hover id
											scrollSpeed: 1200,
											easingType: 'linear' 
								 		};
								 		*/

								 		$().UItoTop({ easingType: 'easeOutQuart' });

								 	});
		</script>
		<a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>	
	</div>
	<!--footer-ends-->
</body>
</html>