<?php 

	require_once '../../connect.php';
	$sub = $_POST['sub'];
	$sem = $_POST['sem'];

	$query = "SELECT * FROM allotment WHERE sub=$sub";
	$result = mysql_query($query);
	if (mysql_num_rows($result) > 0) {
?>
<div class="alert alert-info" role="alert">Subject allready Alloted..!!</div>
<?php
		return;
	}

	$result = array();
	$entry=0;
	for ($i=1; $i <= 4; $i++) { 
		$query = "SELECT staffid, prefexp$i, prefgrade$i, prefreason$i FROM preference WHERE prefsem$i=$sem AND prefsub$i=$sub";
		$res = mysql_query($query);
		$result[$entry++] = $res;
	}

	foreach ($result as $key => $value) {

?>

	<a href="#" onclick="javasript: return false;" id="" class="list-group-item">
		<h4 class="list-group-item-heading" style="color: #CF1616;">Preference <?php echo ($key+1) ?></h4>
		<p class="list-group-item-text">
			<table class="table table-hover">
				<th>Name</th>
				<th>Experience</th>
				<th>Pass percentage</th>
				<th>Special Reason</th>
				<th>Action</th>
				<?php
					while ($data = mysql_fetch_array($value)) {
				?>
				<tr>
					<?php 

						$q2 = "SELECT name FROM staff WHERE loginid=" . $data['staffid'];
						$r2 = mysql_query($q2);
						$name = mysql_fetch_array($r2);
					?>
					<td><?php echo $name['name'] ?></td>
					<td><?php echo $data['prefexp'.($key+1)] ?></td>
					<td><?php echo $data['prefgrade'.($key+1)] ?></td>
					<td><?php echo $data['prefreason'.($key+1)] ?></td>
					<td>
						<input type="button" class="btn btn-success" value="Allot" onclick="allot(<?php echo $data['staffid'] ?>, <?php echo $sub ?>)" />
					</td>
				</tr>
				<?php
					}

				?>
			</table>
		</p>
	</a>

<?php 

	}
?>