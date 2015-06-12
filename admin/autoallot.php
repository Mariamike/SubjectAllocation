<?php 
	
	require_once '../connect.php';

	$query = "SELECT subjects.subjectid FROM subjects WHERE subjects.subjectid NOT IN (SELECT sub FROM allotment)";
	$subjectresult = mysql_query($query);
	while ($subject = mysql_fetch_array($subjectresult)) {
		echo "<br/><br/>";
		$subject_grades = array();
		for ($i=1; $i <= 4; $i++) { 
			$query = "SELECT staffid, prefexp$i, prefgrade$i FROM preference WHERE prefsub$i=" . $subject['subjectid'];
			$graderesult = mysql_query($query);

			while ($data = mysql_fetch_array($graderesult)) {
				$grade = ($data['prefexp' . $i] / 10) + ($data['prefgrade' . $i] / 100) + ((5-$i) / 4);
				$subject_grades[$data['staffid']] = $grade;
				
			}
		}
		echo "subject : " . $subject['subjectid'] . "<br/>";
		foreach ($subject_grades as $key => $value) {
			echo $key . " - " . $value . "<br/>";
		}
		if (count($subject_grades) > 0) {
			$maxgrade = max($subject_grades);
			print_r($subject_grades);
			$selected_staff = array_keys($subject_grades, max($subject_grades));
			$selected_staff = $selected_staff[0];
			echo "<br/>";
			echo "max : " . $maxgrade . "<br/>";
			echo "staff : " . $selected_staff . "<br/>";

			$query = "INSERT INTO allotment(staffid, sub) VALUES($selected_staff," . $subject['subjectid'] . ")";
			mysql_query($query);
		}
		
	}

	$staffs = array();
	$i=0;
	$query = "SELECT staffid FROM staff";
	$staffsresult = mysql_query($query);
	while ($staffdata = mysql_fetch_array($staffsresult)) {
		$staffs[$i++] = $staffdata['staffid'];
	}

	$i = 0;
	$query = "SELECT subjects.subjectid FROM subjects WHERE subjects.subjectid NOT IN (SELECT sub FROM allotment)";
	$subjectresult = mysql_query($query);
	while ($subject = mysql_fetch_array($subjectresult)) {
		$selected_staff = $staffs[$i++];

		$query = "INSERT INTO allotment(staffid, sub, flag) VALUES($selected_staff," . $subject['subjectid'] . ", 0)";
		mysql_query($query);

		if($i>=count($staffs)){
			$i=0;
		}
	}

	header('location: index.php');

?>