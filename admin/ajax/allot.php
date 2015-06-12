<?php 
	require_once '../../connect.php';

	$sub = $_POST['sub'];
	$staffid = $_POST['staffid'];

	$query = "INSERT INTO allotment(staffid, sub) VALUES( $staffid,$sub)";
	mysql_query($query);

	for ($i=1; $i <= 4; $i++) { 
		$query = "SELECT prefid, prefsub$i FROM preference";
		$result = mysql_query($query);
		while ($data = mysql_fetch_array($result)) {
			if($data['prefsub'. $i] == $sub){
				$query = "UPDATE preference SET prefsub$i=0 WHERE prefid=". $data['prefid'];
				mysql_query($query);
			}
		}
	}
?>
<div class="alert alert-info" role="alert">Subject Alloted..!!</div>