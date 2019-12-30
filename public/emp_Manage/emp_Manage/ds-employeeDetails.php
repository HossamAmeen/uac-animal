<?php
	require_once('config.php');

	$employee_id = $_GET['emp_id'];

	// client class 
	$employee= new \stdClass();

    // get client data 
    // select companies data from company table 
	    $employeesql= "select * from employee where id= '{$employee_id}'";
	    $employeeresult = $conn->query($employeesql);
	    echo '[';
	    if($employeeresult->num_rows > 0 )
	    {
	        $x = 1;
	        // select companies data from company table 
	    	    do {
	    		 $employeerow = $employeeresult->fetch_assoc();
				$employee_id = $employeerow['id'];
				$employee->id = $employeerow['id'];
				$employee->name = $employeerow['name'];
				$employee->phone = $employeerow['phoneNum'];
				$employee->image = $employeerow['image'];
				$areaID = $employeerow['area_id'];

				// get company's area 
    		    $areasql = "SELECT name FROM area WHERE id='{$areaID}'";
                $arearesult = $conn->query($areasql);
                
                if ($arearesult->num_rows > 0) {
                    // output data of each row
                    while($arearow = $arearesult->fetch_assoc()) {
                        $employee->area = $arearow['name'];
                    }
                } else {
                    $employee->area = -1;
                }
                
				
				$myJSON = json_encode($employee);
				if($x == $employeeresult->num_rows) {
    	            echo $myJSON;
                } else {
                    echo $myJSON . ',';
                }
			
			    $x++;
			} while($x <= $employeeresult->num_rows);
	    }

    // get visits data from database
    $visitsql = "SELECT * FROM visit where employee_id='{$employee_id}' order by date desc";
	$visitresult = $conn->query($visitsql);
       
	if ($visitresult->num_rows > 0) {
		echo ',{ "Comments" :[';
	    // output data of each row
	   
	     $i =1;
	    do {
	         $visitrow = $visitresult->fetch_assoc();
		    $company_id= $visitrow['company_id'];
		    
		    //get name of the employee
		    $companysql = "SELECT * FROM company where id='{$company_id}'";
			$companyresult = $conn->query($companysql);

			if ($companyresult->num_rows > 0) {
			    // output data of each row
			    while($companyrow = $companyresult->fetch_assoc()) {
				    $company->company = $companyrow['name'];

				}
			}
		    
		    $company->rate = $visitrow['rate'];
		    $company->comment = $visitrow['comment'];
            $company->date = $visitrow['date'];
            $company->time= $visitrow['time'];
            $company->lat = $visitrow['lat'];
            $company->lon = $visitrow['lon'];
            
		        $myJSON = json_encode($company);
				
				 if($i == $visitresult->num_rows) {
    	            echo $myJSON;
                } else {
                    echo $myJSON . ',';
                }
				
				$i++;
	    	}while ($i <= $visitresult->num_rows);
	    	
		echo ']}]';
	} else {
	    echo ',{ "Comments" :[]}';
	    echo "]";
	}
		    
		
?>