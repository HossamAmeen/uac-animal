<?php
    require_once('config.php');
    
    // prochure class
    $moderator= new \stdClass();
     if($_COOKIE["role"] == 'admin') {
        $sql = "SELECT * FROM moderator WHERE trash=0 ORDER BY id desc";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            
            echo '[';
               $i=1;
            do {
                $row = $result->fetch_assoc();
                $area_id = $row['area'];
                $moderator->id = $row['id'];
                $moderator->name= $row['name'];
                $moderator->username= $row['userName'];
                $moderator->phone= $row['phone'];
                
                // get area
                $areasql = "SELECT name FROM area WHERE id='{$area_id}'";
                $arearesult = $conn->query($areasql);
                
                if ($arearesult->num_rows > 0) {
                    
                    while($arearow = $arearesult->fetch_assoc()) {
                        $moderator->area = $arearow['name'];
                    }
                } else {
                    $moderator->area = null;
                }
                
                $myJSON = json_encode($moderator);
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