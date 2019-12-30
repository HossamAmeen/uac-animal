<?php 
	require_once('config.php');
	
	$compName= trim($_POST['compName']);
	$phone= trim($_POST['phone']);
	$kind= $_POST['kind'];
	$empID= $_POST['empID'];
	$managerName= trim($_POST['managerName']);

	// success class 
	$success= new \stdClass();
	
	// query to select area_id
	$areasql= "SELECT area_id FROM employee WHERE id='{$empID}'";
	$arearesult = $conn->query($areasql);

	if ($arearesult->num_rows > 0) {
	    // output data of each row
	    while($arearow = $arearesult->fetch_assoc()) {
		    $area_id= $arearow['area_id'];
		    
		    // insert data into company
		$sql = "INSERT INTO company (name, phone, kind, area_id)
		VALUES ('{$compName}', '{$phone}', '{$kind}', '{$area_id}')";

		if ($conn->query($sql) === TRUE) {
			$last_id = $conn->insert_id;
		    // insert data in manager
			$managersql = "INSERT INTO manager( name, phone, company_id) 
			VALUES ('{$managerName}', '{$phone}', '{$last_id}')";

				if ($conn->query($managersql) === TRUE) {

					//define which kind this company related to
					if($kind== 1) {
						// this company is ranch مزرعة so insert into ranch
						$number = trim($_POST['number']);
						$ranchKind= trim($_POST['ranchKind']);
						$age= trim($_POST['age']);
						$weight= trim($_POST['weight']);
						$production= $_POST['production'];

						$ranchsql = "INSERT INTO ranch (company_id, number, kind, age, weight, production)
							VALUES ('{$last_id}', '{$number}', '{$ranchKind}', '{$age}', '{$weight}', '{$production}')";

							if ($conn->query($ranchsql) === TRUE) {
								$ranch_id = $conn->insert_id;

								if($production == 0) {
									$milkPhase= trim($_POST['milkPhase']);
									$quantity = trim($_POST['quantity']);

									// if $production == 0 so it is milk ranch
									$milksql = "INSERT INTO milk (ranch_id, milk_phase, quantity)
										VALUES ('{$ranch_id}', '{$milkPhase}', '{$quantity}')";

										if ($conn->query($milksql) === TRUE) {
											$success->done = 1;
										} else {
											$success->done = -1;
										}
								}
								else if($production == 1) {
							
	//								if $production==1 so it fattening ranch

									$fattingPhase= trim($_POST['fattingPhase']);
									$talaak = trim($_POST['talaak']);
									$talaakNum= trim($_POST['talaakNum']);
									$number = trim($_POST['number2']);

									$fatsql = "INSERT INTO fattening (ranch_id, fatting_phase, talaak, talaakNum, number)
										VALUES ('{$ranch_id}', '{$fattingPhase}', '{$talaak}', '{$talaakNum}', '{$number}')";

										if ($conn->query($fatsql) === TRUE) {
											$success->done = 1;
										} else {
											$success->done = -1;
										}
								}
							} else {
								$success->done = -1;
							}
					}
					elseif($kind==2) {
						$productionKind= trim($_POST['productionKind']);
						$capacity = trim($_POST['capacity']);
						$menitor= trim($_POST['menitor']);

						// this company is factor so insert into factor
						$factorsql = "INSERT INTO factory (company_id, productionKind, capacity, menitor) 
							VALUES ('{$last_id}', '{$productionKind}', '{$capacity}', '{$menitor}')";

							if ($conn->query($factorsql) === TRUE) {
								$success->done = 1;
							} else {
								$success->done = -1;
								echo "mahmoud";
							}
					}
					elseif($kind==3) {
						$desc= $_POST['desc'];

						// this company is showroom so insert into showroom
						$showroomsql = "INSERT INTO showroom (company_id, description)
							VALUES ('{$last_id}', '{$desc}')";

							if ($conn->query($showroomsql) === TRUE) {
								$success->done = 1;
							} else {
								$success->done = -1;
							}
					}
					elseif($kind==4) {
						$specialization = $_POST['specialization'];

						// this company is doctor so insert into doctor
						$doctorsql = "INSERT INTO doctor (company_id, specialization)
							VALUES ('{$last_id}', '{$specialization}')";

							if ($conn->query($doctorsql) === TRUE) {
								$msg = 'data successfully added to doctor table ';
							} else {
								$msg = 'error in add data in doctor table';
							}
					}

				} else {
					$success->done = -1;

				}
		} else {
			$success->done = -1;	
		}
	    }
	} else {
		$success->done = -1;
	}

	$myJSON = json_encode($success);
	echo $myJSON;
	$conn->close();
?>