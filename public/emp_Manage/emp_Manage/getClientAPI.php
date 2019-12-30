<?php
	require_once('config.php');

	$company_id = $_GET['compID'];

	// client class 
	$company= new \stdClass();

    // get visits data from database
    $visitsql = "SELECT * FROM visit where company_id='{$company_id}'";
	$visitresult = $conn->query($visitsql);

	if ($visitresult->num_rows > 0) {
		echo '{"Comments" :[';
	    // output data of each row
	   
	     $i =1;
	    do {
	         $visitrow = $visitresult->fetch_assoc();
		    $emp_id= $visitrow['employee_id'];
		    
		    //get name of the employee
		    $employeesql = "SELECT * FROM employee where id='{$emp_id}'";
			$employeeresult = $conn->query($employeesql);

			if ($employeeresult->num_rows > 0) {
			    // output data of each row
			    while($employeerow = $employeeresult->fetch_assoc()) {
				    $company->employeeName= $employeerow['name'];
				    $company->employeePhone= $employeerow['phoneNum'];
				    $company->employeeImage= $employeerow['image'];
				}
			}
		    
		    $company->rate = $visitrow['rate'];
		    $company->comment = $visitrow['comment'];
            $company->date = $visitrow['date'];
            $company->time= $visitrow['time'];
            
		        $myJSON = json_encode($company);
				
				 if($i == $visitresult->num_rows) {
    	            echo $myJSON;
                } else {
                    echo $myJSON . ',';
                }
				
				$i++;
	    	}while ($i <= $visitresult->num_rows);
	    	
		echo ']}';
	} else {
	    
	}
		    
		
?>