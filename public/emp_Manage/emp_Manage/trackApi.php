
<?php
	require_once('config.php');
	

	$lat = trim($_POST['lat']);
	$lng = trim($_POST['lon']);
	$date = trim($_POST['date']);
	$active = trim($_POST['active']);
	$eid = trim($_POST['empID']);
	$sql = "INSERT INTO Tracking (id, empid, lat, lng, date, active) VALUES (NULL, '{$eid}', '{$lat}', '{$lng}', '{$date}', '{$active}')";

	if ($conn->query($sql) === TRUE) {
		    $success->done = 1;
		} else {
		    $success->done = -1;
		}
		$myJSON = json_encode($success);
		echo $myJSON;


	$conn->close()
?>
