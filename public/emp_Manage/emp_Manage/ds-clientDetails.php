<?php
	require_once('config.php');

	$company_id = $_GET['company_id'];

	// client class 
	$company= new \stdClass();

    // get client data 
    // select companies data from company table 
	    $companiessql= "select * from company where id= '{$company_id}'";
	    $companiesresult = $conn->query($companiessql);
	    echo '[';
	    if($companiesresult->num_rows > 0 )
	    {
	        $x = 1;
	        // select companies data from company table 
	    	    do {
	    		 $companiesrow = $companiesresult->fetch_assoc();
				$company_id = $companiesrow['id'];
				$client->id = $companiesrow['id'];
				$client->name = $companiesrow['name'];
				$client->phone = $companiesrow['phone'];
				$client->image = $companiesrow['image'];
				$areaID = $companiesrow['area_id'];
				$kind =  $companiesrow['kind'];
				
				// get company's area 
    		    $areasql = "SELECT name FROM area WHERE id='{$areaID}'";
                $arearesult = $conn->query($areasql);
                
                if ($arearesult->num_rows > 0) {
                    // output data of each row
                    while($arearow = $arearesult->fetch_assoc()) {
                        $client->area = $arearow['name'];
                    }
                } else {
                    $client->area = -1;
                }
                
                // get company's manager 
    		    $managersql = "SELECT name FROM manager WHERE company_id='{$company_id}'";
                $managerresult = $conn->query($managersql);
                
                if ($managerresult->num_rows > 0) {
                    // output data of each row
                    while($managerrow = $managerresult->fetch_assoc()) {
                        $client->manager = $managerrow['name'];
                    }
                } else {
                    $client->manager = -1;
                }
				
				// this company is ranch مزرع
				if($kind == 1) {
				    $client->type = 'مزرعة';
				    
				    $ranch = new \stdClass();
        		    $ranchsql = "SELECT * FROM ranch WHERE company_id='{$company_id}'";
                    $ranchresult = $conn->query($ranchsql);
                    
                    if ($ranchresult->num_rows > 0) {
                        // output data of each row
                        while($ranchrow = $ranchresult->fetch_assoc()) {
                            $ranchID = $ranchrow['ranch_id'];
                            $ranch->number = $ranchrow['Number'];
                            $ranch->kind = $ranchrow['kind'];
                            $ranch->age = $ranchrow['age'];
                            $ranch->weight= $ranchrow['weight'];
                            $ranch-> production= $ranchrow['production'];
                            $production= $ranchrow['production'];
                            
                            if($production == 0) {
                                $client->type = 'مزرعة ألبان';
                                // milk ranch
                                $milksql = "SELECT * FROM milk WHERE ranch_id='{$ranchID}'";
                                $milkresult = $conn->query($milksql);
                                
                                if ($milkresult->num_rows > 0) {
                                    // output data of each row
                                    while($milkrow = $milkresult->fetch_assoc()) {
                                        $ranch->milkPhase = $milkrow['milk_phase'];
                                        $ranch->quantity = $milkrow['quantity'];
                                    }
                                } 
                            }
                            if($production == 1) {
                                $client->type = 'مزرعة تسمين';
                                // fattening ranch
                                 $fatsql = "SELECT * FROM fattening WHERE ranch_id='{$ranchID}'";
                                $milkresult = $conn->query($milksql);
                                
                                if ($milkresult->num_rows > 0) {
                                    // output data of each row
                                    while($milkrow = $milkresult->fetch_assoc()) {
                                        $ranch->fattingPhase = $milkrow['milk_phase'];
                                        $ranch->talaak = $milkrow['talaak'];
                                        $ranch->talaakNum = $milkrow['talaakNum'];
                                        $ranch->number = $milkrow['number'];
                                    }
                                } 
                            }
                        }
                        $client->ranch = $ranch;
                    } else {
                        $client->ranch = -1;
                    }
				    
				}
				// this company is factor
				if($kind == 2) {
				    $client->type = 'مصنع';
				    $factory = new \stdClass();
        		    $factorysql = "SELECT * FROM factory WHERE company_id='{$company_id}'";
                    $factoryresult = $conn->query($factorysql);
                    
                    if ($factoryresult->num_rows > 0) {
                        // output data of each row
                        while($factoryrow = $factoryresult->fetch_assoc()) {
                            $factory->productionKind = $factoryrow['productionKind'];
                            $factory->capacity = $factoryrow['capacity'];
                            $factory->menitor = $factoryrow['menitor'];
                        }
                        
                        $client->factory = $factory;
                    } else {
                        $client->factory = -1;
                    }
				}
				// this company is showroom
				if($kind == 3) {
				    $client->type = 'معرض';
				    $showroom = new \stdClass();
				    $showroomsql = "SELECT * showroom area WHERE company_id='{$company_id}'";
                    $showroomresult = $conn->query($showroomsql);
                    
                    if ($showroomresult->num_rows > 0) {
                        // output data of each row
                        while($showroomrow = $showroomresult->fetch_assoc()) {
                            $showroom->desc = $showroomrow['description'];
                        }
                        $client->showroom = $showroom;
                    } else {
                        $client->showroom = -1;
                    }
				}
				// this company is doctor
				if($kind == 4) {
				    $client->type = 'دكتور';
				    $doctor = new \stdClass();
				    
				    $doctor = new \stdClass();
				    $doctorsql = "SELECT * doctor area WHERE company_id='{$company_id}'";
                    $doctorresult = $conn->query($doctorsql);
                    
                    if ($doctorresult->num_rows > 0) {
                        // output data of each row
                        while($doctorrow = $doctorresult->fetch_assoc()) {
                            $doctor->specialization = $showroomrow['specialization'];
                        }
                        $client->doctor = $doctor;
                    } else {
                        $client->doctor = -1;
                    }
				}
				
				$myJSON = json_encode($client);
				if($x == $companiesresult->num_rows) {
    	            echo $myJSON;
                } else {
                    echo $myJSON . ',';
                }
			
			    $x++;
			} while($x <= $companiesresult->num_rows);
	    }

    // get visits data from database
    $visitsql = "SELECT * FROM visit where company_id='{$company_id}'";
	$visitresult = $conn->query($visitsql);
       
	if ($visitresult->num_rows > 0) {
		echo ',{ "Comments" :[';
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
				    $company->employee = $employeerow['name'];
				    $company->employeePhone= $employeerow['phoneNum'];
				    $company->employeeImage= $employeerow['image'];
				    
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