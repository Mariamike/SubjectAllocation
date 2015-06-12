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
		var a = [];
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});

			$("#name_group").find('a').each(function(){
				a.push($(this));
			});
		});
	</script>

	<script type="text/javascript">

	$(document).ready(function(){
		$("#print_btn").click(function(){

			$("#body_content").hide();
			$(".not-display").hide();
			// $("#print_content").html($("#alot_table"));
			$("#alot_table").clone().appendTo("#print_content");
			window.print();
			$("#print_content").empty();
			$("#body_content").show();
			$(".not-display").show();
		});

		$(".edit-btn").click(function(){
			$(this).parent().parent().find('label').hide();
			$(this).parent().parent().find('select').show();
			$(this).parent().find('.option-btn').show();
			// $(this).find('button').show();
			$(this).hide();
		});

	});


		function save_change(id){
			var staff = $("#save_"+id).parent().parent().find('select').val();
			$.ajax({
				url: "ajax/editallot.php",
				method: "POST",
				data: { id : id,
						staff :  staff
					}
			}).done(function( msg ) {
				$("#save_"+id).parent().parent().removeClass("warning");
				$("#save_"+id).parent().parent().addClass("success");
				$("#save_"+id).parent().parent().find('edit-btn').hide();
				$("#save_"+id).parent().parent().find('label').val(msg);
				$("#save_"+id).parent().parent().find('label').show();
				$("#save_"+id).parent().parent().find('select').hide();
				$("#save_"+id).parent().parent().find('.option-btn').hide();
				console.log(msg);
			}).fail(function( jqXHR, textStatus ) {
				alert( "Request failed: " + textStatus );
			});
		}

		function cancel_change(id){
			$("#cancel_"+id).parent().parent().find('.edit-btn').show();
			$("#cancel_"+id).parent().parent().find('label').show();
			$("#cancel_"+id).parent().parent().find('select').hide();
			$("#cancel_"+id).parent().parent().find('.option-btn').hide();
		}


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

		function action(id, action){

			if (action == 1) {
				var act = 'accept';
			}
			else{
				var act = 'reject';
			}
			if (confirm("Do you realy want to "+act)) {
				window.location.href="regaction.php?id="+id+"&action="+action;
			}
		}

		function filter_name(){
			var result = $("#name_filter").val();

			for(var i in a){
				if (a[i].attr('id') === result) {
					$("#name_group").html(a[i]);
					return;
				}
			}
			$("#name_group").html("<div class=\"alert alert-info\" role=\"alert\">No preference found..!!</div>");
		}

		function filter_subject(){
			$.ajax({
				url: "ajax/subjectfilter.php",
				method: "POST",
				data: {
					sub : $("#result_sub").val(),
					sem : $("#result_sem").val()
					 }
			}).done(function( msg ) {
				$( "#name_group" ).html( msg );
			}).fail(function( jqXHR, textStatus ) {
				alert( "Request failed: " + textStatus );
			});
		}

		function allot(staffid, sub){
			$.ajax({
				url: "ajax/allot.php",
				method: "POST",
				data: {
						sub : sub,
						staffid : staffid
					 }
			}).done(function( msg ) {
				$( "#name_group" ).html( msg );
			}).fail(function( jqXHR, textStatus ) {
				alert( "Request failed: " + textStatus );
			});
		}
		function allot_automatically(){
			window.location.href="autoallot.php";
		}
	</script>

	<style type="text/css">
		.cbp-spmenu-right.cbp-spmenu-open{
			width: 51%;
		}
		.cbp-spmenu-right{
			right: -1000px;
		}
	</style>
	<!--start-smoth-scrolling-->
</head>
<body>
	<div id="body_content">
	
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
							<a class="scroll" href="#registrations">NEW REGISTRATIONS</a>
							<a class="scroll" href="#about">ALLOTMENTS</a>
							<a class="scroll" href="#stories">PREFERENCES</a>
							<a class="scroll" href="#hello">REQUESTS</a>
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
	<div class="about" id="registrations">
		<div class="container">
			<div class="about-mian">
				<img src="../images/abt-1.png" alt=""/>
				<h3>New Registrations</h3>
				<?php 

				$query = "SELECT loginid FROM login WHERE status=0";
				$result = mysql_query($query);
				if(mysql_num_rows($result) > 0){
					?>
					<table class="table table-hover" style="text-align: left">
						<th>No</th>
						<th>Name</th>
						<th>Designation</th>
						<th>Email</th>
						<th>Joining</th>
						<th>Action</th>

						<?php
						$i = 1;
						while ($logindata = mysql_fetch_array($result)) {
							$loginid = $logindata['loginid'];
							$query = "SELECT * FROM staff WHERE loginid=$loginid";

							$result2 = mysql_query($query);
							$data = mysql_fetch_array($result2);

							?>

							<tr>
								<td><?php echo $i++ ?></td>
								<td><?php echo $data['name'] ?></td>
								<td><?php echo $data['designation'] ?></td>
								<td><?php echo $data['email'] ?></td>
								<td><?php echo $data['joindate'] ?></td>
								<td><input type="button" class="btn btn-success" value="Accept" onclick="action(<?php echo $loginid ?>, 1)" /><input type="button" class="btn btn-danger" value="Reject" onclick="action(<?php echo $loginid ?>, 0)" /></td>
							</tr>
							<?php
						}
						?>

					</table>
					<?php
				}
				else{
					?>
					<div class="alert alert-info" role="alert">No new Registrations</div>
					<?php
				}

				?>
			</div>
		</div>
	</div>

	<!--about-starts-->
	<div class="about" id="about">
		<div class="container">
			<div class="about-mian">
				<img src="../images/abt-1.png" alt=""/>
				<h3>Allotments</h3>
				<table id="alot_table" class="table table-hover" style="text-align: left">
					<th>No</th>
					<th>Semester</th>
					<th>Subject</th>
					<th>Staff</th>
					<th></th>
					<tr>
						<td colspan="5" style="color: #f60">THEORY</td>
					</tr>
					<?php 
						$query = "SELECT * FROM allotment ORDER BY sub ASC";
						$result = mysql_query($query);
						$i = 1;
						$lab_subjects = array();

						$k = 0;
						while ($data = mysql_fetch_array($result)) {
							if ($data['flag']==0) {
								Print "<tr class='warning'>";
							}
							else{
								Print "<tr>";
							}
					?>
						
						<?php 
							$query = "SELECT * FROM subjects WHERE subjectid=" . $data['sub'];
							$subjectresult = mysql_query($query);
							$subject = mysql_fetch_array($subjectresult);

							$query = "SELECT semester FROM semester WHERE semesterid=" . $subject['semesterid'];
							$semester_result = mysql_query($query);
							$semester = mysql_fetch_array($semester_result);
							if ($subject['type'] == 'LAB') {
								$lab_subjects[$k++] = array('semester' => $semester['semester'], 'subject' => $subject['subject'], 'staff' => $data['staffid'], 'flag' => $data['flag'], 'allotid' => $data['allotid']);
								continue;
							}
						?>
						<td><?php echo $i++ ?></td>
						<td><?php echo $semester['semester'] ?></td>
						<td><?php echo $subject['subject'] ?></td>
						<?php 
							$query = "SELECT name FROM staff WHERE loginid=" . $data['staffid'];
							$staffresult = mysql_query($query);
							$staff = mysql_fetch_array($staffresult);
						?>
						<td>
							<label class="staff-name"><?php echo $staff['name'] ?></label>
							<select class="edit-name">
							<?php 
								$query = "SELECT * FROM staff";
								$staffs = mysql_query($query);
								while ($stf = mysql_fetch_array($staffs)) {
								
							 ?>
								<option value="<?php echo $stf['staffid'] ?>"><?php echo $stf['name'] ?></option>
							<?php 
								}
							 ?>
							</select>
						</td>
						<?php 
							if ($data['flag'] == 0) {
						?>
						<td class="not-display">
							<button class="btn edit-btn btn-default">edit</button>
							<button id="save_<?php echo $data['allotid'] ?>" class="btn option-btn btn-primary" onclick="save_change(<?php echo $data['allotid'] ?>)">save</button>
							<button id="cancel_<?php echo $data['allotid'] ?>" class="btn option-btn btn-default" onclick="cancel_change(<?php echo $data['allotid'] ?>)">cancel</button>
						</td>
						<?php
							}
							else{
						?>
						<td class="not-display"></td>
						<?php
							}
						?>
					</tr>
					<?php
						}
					?>
					<tr>
						<td colspan="5" style="color: #f60">LAB</td>
					</tr>
					
					<?php 
						$i = 1;
						foreach ($lab_subjects as $value) {
							if ($value['flag']==0) {
								Print "<tr class='warning'>";
							}
							else{
								Print "<tr>";
							}
					?>
						<td><?php echo $i++ ?></td>
						<td><?php echo $value['semester'] ?></td>
						<td><?php echo $value['subject'] ?></td>
						<?php 
							$query = "SELECT name FROM staff WHERE loginid=" . $value['staff'];
							$staffresult = mysql_query($query);
							$staff = mysql_fetch_array($staffresult);
						?>
						<td>
							<label class="staff-name"><?php echo $staff['name'] ?></label>
							<select class="edit-name">
							<?php 
								$query = "SELECT * FROM staff";
								$staffs = mysql_query($query);
								while ($stf = mysql_fetch_array($staffs)) {
								
							 ?>
								<option value="<?php echo $stf['staffid'] ?>"><?php echo $stf['name'] ?></option>
							<?php 
								}
							 ?>
							</select>
						</td>
						<?php 
							if ($value['flag'] == 0) {
						?>
						<td class="not-display">
							<button class="btn edit-btn btn-default">edit</button>
							<button id="save_<?php echo $value['allotid'] ?>" class="btn option-btn btn-primary" onclick="save_change(<?php echo $value['allotid'] ?>)">save</button>
							<button id="cancel_<?php echo $value['allotid'] ?>" class="btn option-btn btn-default" onclick="cancel_change(<?php echo $value['allotid'] ?>)">cancel</button>
						</td>
						<?php
							}
							else{
						?>
						<td class="not-display"></td>
						<?php
							}
						?>
					</tr>
					<?php
						}
					?>
					
				</table>
				<button id="print_btn" class="btn btn-primary btn-block">Print</button>
			</div>
		</div>
	</div>
	<!--about-ends-->
	
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
	<!--portfolio-ends-->
	

	<div class="team" id="hello">
		<div class="container">
			<div class="team-top">
				<h3>Manual allocation</h3>
				<p> Here you can allot manually</p>
			</div>

			<div class="row form-horizontal" style="margin-top: 3em;">
				<div class="col-md-6 form-group">
					<label class="col-sm-6 control-label">Name</label>
					<select id="name_filter" class="col-sm-6 form-control" onchange="filter_name()">
						<option>Select</option>
						<?php 
						$query = "SELECT * FROM staff";
						$result = mysql_query($query);

						while ($data=mysql_fetch_array($result)) {
							?>

							<option value="pref_<?php echo $data['loginid'] ?>"><?php echo $data['name'] ?></option>
							<?php
						}
						?>
					</select>
				</div>
				<div class="col-md-6 form-group">
					<label class="col-md-6 control-label">Semester</label>
					<select id="result_sem" class="col-md-6 form-control" onchange="getsubjects(result_sem, 'result_sub')">
						<option>Select</option>
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
					<label class="col-md-6 control-label">Subject</label>
					<select id="result_sub" class="col-md-6 form-control" onchange="filter_subject()">
						<option>Select</option>
					</select>
				</div>
			</div>

			<div id="subjects_result" class="team-bottom" style="text-align: left; margin-top: 2em;">
				<div id="name_group" class="list-group">
																								<h1>Consolidated View Of Each Staff Preference</h1>

					<?php 
					$query = "SELECT * FROM preference";
					$result = mysql_query($query);
					while ($data = mysql_fetch_array($result)) {


						?>

						<a href="#" id="pref_<?php echo $data['staffid'] ?>" class="list-group-item">
							<?php 
							$q2 = "SELECT name FROM staff WHERE loginid=" . $data['staffid'];
							$r2 = mysql_query($q2);
							$name = mysql_fetch_array($r2);
							?>
							<h4 class="list-group-item-heading" style="color: #CF1616;"><?php echo $name['name'] ?></h4>
							<p class="list-group-item-text">

								<table class="table">
									<th></th>
									<th>Semester</th>
									<th>Subject</th>
									<th>Experience</th>
									<th>Pass Percentage</th>
									<th>Special Reasons</th>
									<?php 

									for ($i=1; $i <= 4; $i++) { 
										if ($data['prefsub' . $i] != 0) {

										?>
										<tr>
											<td>Preferance <?php echo $i ?></td>
											<td>
												<?php 
												$q3 = "SELECT semester FROM semester WHERE semesterid=" . $data['prefsem' . $i];
												$r3 = mysql_query($q3);
												$sem = mysql_fetch_array($r3);
												echo $sem['semester'];
												?>
											</td>
											<td>
												<?php 
												$q4 = "SELECT subject FROM subjects WHERE subjectid=" . $data['prefsub' . $i];
												$r4 = mysql_query($q4);
												$sub = mysql_fetch_array($r4);
												echo $sub['subject'];
												?>
											</td>
											<td>
												<?php echo $data['prefexp' . $i] ?>
											</td>
											<td>
												<?php echo $data['prefgrade' . $i] ?>
											</td>
											<td>
												<?php echo $data['prefreason' . $i] ?>
											</td>
										</tr>
										<?php 
										}
									}
									?>
								</table>
							</p>
						</a>
						<?php 

					}
					?>
				</div>
			</div>
			<div id="allot_auto" class="col-md-12">
				<input type="button" class="btn btn-primary btn-block" value="Allot Automatically" onclick="allot_automatically()">
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


	<!--footer-starts-->
	<!--<div class="footer" id="footer">
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
	</div>
	<div id="print_content">
		
	</div>
</body>
</html>