<?php
	session_start();
	
	header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    

	
	define("DB_SERVER", "localhost");
	define("DB_USER", "mahmoudkamal");
	define("DB_PASS", "egypt123");
	define("DB_NAME", "employee_manage");

  // 1. Create a database connection
  $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  // Test if connection succeeded
  if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }
?>
