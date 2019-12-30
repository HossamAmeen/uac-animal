<?php
	require_once('config.php');
	

	$empID= $_GET['empID'];

    //select area ID of the employee
	$areasql = "SELECT area_id FROM employee where id='{$empID}'";
	$arearesult = $conn->query($areasql);

	// client class 
	$client= new \stdClass();

	if ($arearesult->num_rows > 0) {
	    // output data of each row
	    $i=1;
	    do {
	     $arearow = $arearesult->fetch_assoc();
		  $areaID = $arearow['area_id'];
		    
		    
		    // select companies data from company table 
		    $companiessql= "select * from company where area_id= '{$areaID}'";
		    $companiesresult = $conn->query($companiessql);
		    
		    if($companiesresult->num_rows > 0 )
		    {
		        $x = 1;
			    echo '{"Companys":[';
			    
			    // select companies data from company table 
	    	    do {
    	    		 $companiesrow = $companiesresult->fetch_assoc();
    				$company_id = $companiesrow['id'];
    				$client->id = $companiesrow['id'];
    				$client->name = $companiesrow['name'];
    				$client->phone = $companiesrow['phone'];
    				$client->image = $companiesrow['image'];
				
				    // select average rate of each company in this area
    				$visitsql = "SELECT * FROM visit WHERE company_id='{$company_id}'";
    				$visitresult = $conn->query($visitsql);
    
    				if ($visitresult->num_rows > 0) {
    					$rate = 0;
    					$counter= 0;
    					while($visitrow = $visitresult->fetch_assoc()) {
    						$rate += $visitrow['rate'];
    						$counter+=1;
    				 		$client->lon = $visitrow['lon'];
    				 		$client->lat = $visitrow['lat'];
    				 		
    				 		// get number of date last from last visit
    				 		$now = time();
                            $your_date = strtotime($visitrow['date']);
                            $datediff = $now - $your_date;
                            
                            $days = round($datediff / (60 * 60 * 24));
    				 		if($days < 30) {
    				 		    $client->duration = 1;
    				 		}else {
    				 		    $client->duration = 2;
    				 		}
    					}
    					
    					$average = $rate/$counter;
    					
    					$average = round($average);
    				 	$client->rate = $average;
    				} else {
    					$client->rate = 0;
    				}
				
        			$myJSON = json_encode($client);
        			if($x == $companiesresult->num_rows) {
        	            echo $myJSON;
                    } else {
                        echo $myJSON . ',';
                    }
			
			        $x++;
			} while($x <= $companiesresult->num_rows);
			    
			   
		     } else {
			    echo '{"Companys":[';
			    $client->id = -1;
			    $myJSON = json_encode($client);
				
				if($i == $arearesult->num_rows) {
    	            echo $myJSON;
                } else {
                    echo $myJSON . ',';
                }
			}
			
            
			$i++;
		}while($i<=$arearesult->num_rows);
			
		 echo ']}';
	} 
	else {
	    echo '[';
	    $client->id = -1;
	    $myJSON = json_encode($client);
		echo $myJSON;
	    echo ']';
	}

	$conn->close();
?>