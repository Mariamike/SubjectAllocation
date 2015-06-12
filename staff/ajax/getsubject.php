<?php 
	require_once '../../connect.php';
	$sem = $_POST['sem'];
	$query = "SELECT * FROM subjects WHERE semesterid=$sem AND type='THEORY'";

	$result = mysql_query($query);
	while ($data = mysql_fetch_array($result)) {
?>
<option value="<?php echo $data['subjectid'] ?>"><?php echo $data['subject'] ?></option>
<?php
	}
?>