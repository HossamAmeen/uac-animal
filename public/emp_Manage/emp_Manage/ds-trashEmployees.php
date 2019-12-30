<?php
    require_once('config.php');
    
    // prochure class
    $employee= new \stdClass();
    if($_COOKIE["role"] == 'admin') {
        $sql = "SELECT id, name, phoneNum, area_id FROM employee WHERE trash=1";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
          
            echo '[';
               $i=1;
            do {
                $row = $result->fetch_assoc();
                $area_id = $row['area_id'];
                $employee->id = $row['id'];
                $employee->name= $row['name'];
                $employee->phone= $row['phoneNum'];
                
                // get area
                $areasql = "SELECT name FROM area WHERE id='{$area_id}'";
                $arearesult = $conn->query($areasql);
                
                if ($arearesult->num_rows > 0) {
                    
                    while($arearow = $arearesult->fetch_assoc()) {
                        $employee->area = $arearow['name'];
                    }
                } else {
                    $employee->area = null;
                }
                
                $myJSON = json_encode($employee);
                if($i == $result->num_rows) {
    	            echo $myJSON;
                } else {
                    echo $myJSON . ',';
                }
    	       $i++;
            }while($i<=$result->num_rows);
            
            echo ']';
        } else {
            echo "[]";
        }
        
    }
    
    else if($_COOKIE["role"] == 'moderator') {
        $area = $_COOKIE['area'];
        
        $sql = "SELECT id, name, phoneNum, area_id FROM employee WHERE trash=0 AND area_id='{$area}'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
          
            echo '[';
               $i=1;
            do {
                $row = $result->fetch_assoc();
                $area_id = $row['area_id'];
                $employee->id = $row['id'];
                $employee->name= $row['name'];
                $employee->phone= $row['phoneNum'];
                
                // get area
                $areasql = "SELECT name FROM area WHERE id='{$area_id}'";
                $arearesult = $conn->query($areasql);
                
                if ($arearesult->num_rows > 0) {
                    
                    while($arearow = $arearesult->fetch_assoc()) {
                        $employee->area = $arearow['name'];
                    }
                } else {
                    $employee->area = null;
                }
                
                $myJSON = json_encode($employee);
                if($i == $result->num_rows) {
    	            echo $myJSON;
                } else {
                    echo $myJSON . ',';
                }
    	       $i++;
            }while($i<=$result->num_rows);
            
            echo ']';
        } else {
            echo "[]";
        }
        
    }
    $conn->close();

?>