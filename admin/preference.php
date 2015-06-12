<?php 
	session_start();
	require_once '../connect.php';

	$form = $_POST['form'];
	$prefkey = "";
	$prefvalue = "";
	if ($form == 'theory') {
		$limit = 4;
	}
	else{
		$limit = 2;
	}

	for ($i=1; $i <= $limit; $i++) { 
		$prefkey .= "prefsem$i, prefsub$i, prefexp$i, prefgrade$i, prefreason$i, ";
		$prefvalue .= $_POST['prefsem'.$i] . ", " . $_POST['prefsub'.$i] . ", " . $_POST['prefexp'.$i] . ", " . $_POST['prefgrade'.$i] . ", '" . $_POST['prefreason'.$i] . "', ";
	}
	$prefkey = rtrim(rtrim($prefkey), ',');
	$prefvalue = rtrim(rtrim($prefvalue), ',');

	$prefkey = "staffid, " . $prefkey;
	$prefvalue = $_SESSION['loginid'] . ", " . $prefvalue;

	$query = "INSERT INTO preference ($prefkey) VALUES ($prefvalue)";
	echo $query;
	mysql_query($query);
	echo "<script>alert(\"Preference saved\"); window.location.href=\"index.php\"</script>";

?>