<?php
	require_once('config.php');
	

	$username = trim($_GET['username']);
	$password = trim($_GET['password']);

	$empsql = "SELECT id FROM employee where username='{$username}' AND password='{$password}'";
	$empresult = $conn->query($empsql);

	$emp= new \stdClass();

	if ($empresult->num_rows > 0) {
	    // output data of each row
	    while($emprow = $empresult->fetch_assoc()) {
		  $emp->id= $emprow['id'];
	    }
	} else {
	    $emp->id= -1;
	}

	$myJSON = json_encode($emp);
	echo $myJSON;

	$conn->close();
?>