<?php 
	require_once('config.php');
	
	$empID=	 trim($_POST['empID']);
	$compID= 	trim($_POST['compID']);
	$comment= 	trim($_POST['comment']);
	$rate= 	trim($_POST['rate']);
	$lon= 	trim($_POST['lon']);
	$lat= 	trim($_POST['lat']);
	
	// success class 
	$success= new \stdClass();
	
// 	get date and time
    $date = date("Y-m-d");
    $time = date("h:i:s");
	
	if(isset($empID) || isset($compID) || isset($comment)) {
		$sql = "INSERT INTO visit (employee_id, company_id, date, time, rate, comment, lon, lat)
		VALUES ('{$empID}', '{$compID}', '{$date}', '{$time}', '{$rate}', '{$comment}', '{$lon}', '{$lat}')";

		if ($conn->query($sql) === TRUE) {
		    $success->done = 1;
		} else {
		    $success->done = -1;
		}
		$myJSON = json_encode($success);
		echo $myJSON;
	} else {
		$success->done = -1;
		$myJSON = json_encode($success);
		echo $myJSON;
	}

	$conn->close();
?>