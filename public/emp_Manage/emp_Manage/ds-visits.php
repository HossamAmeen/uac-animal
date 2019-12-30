<?php
    require_once('config.php');
    
    // client class 
	$visit= new \stdClass();
    
     // get visits data from database
    $visitsql = "SELECT * FROM visit order by date desc";
	$visitresult = $conn->query($visitsql);
    
    echo '[';
    if ($visitresult->num_rows > 0) {
        // output data of each row
        $i = 1;
        do {
            
          $visitrow = $visitresult->fetch_assoc();
		    $emp_id= $visitrow['employee_id'];
		    $company_id = $visitrow['company_id'];
		    $visit->id= $visitrow['id'];
		    
		    //get name of the employee
		    $employeesql = "SELECT * FROM employee where id='{$emp_id}'";
			$employeeresult = $conn->query($employeesql);

			if ($employeeresult->num_rows > 0) {
			    // output data of each row
			    while($employeerow = $employeeresult->fetch_assoc()) {
				    $visit->employee = $employeerow['name'];

				}
			}
			
			//get name of the employee
		    $companysql = "SELECT id, name FROM company where id='{$company_id}'";
			$companyresult = $conn->query($companysql);

			if ($companyresult->num_rows > 0) {
			    // output data of each row
			    while($companyrow = $companyresult->fetch_assoc()) {
			        $visit->companyId = $companyrow['id'];
				    $visit->companyname = $companyrow['name'];

				}
			}
			
			 $visit->rate = $visitrow['rate'];
		    $visit->comment = $visitrow['comment'];
            $visit->date = $visitrow['date'];
            $visit->time= $visitrow['time'];
            
            $myJSON = json_encode($visit);
				
			 if($i == $visitresult->num_rows) {
	            echo $myJSON;
            } else {
                echo $myJSON . ',';
            }
            
            $i++;
        } while ($i <= $visitresult->num_rows);
        
        echo ']';
    } else {
        echo ']';
    }
?>