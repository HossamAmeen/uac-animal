<?php
    require_once('config.php');
    
    // prochure class
    $area= new \stdClass();
     
        $sql = "SELECT * FROM area WHERE trash=0 ORDER BY id desc";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
          
            echo '[';
               $i=1;
            do {
                $row = $result->fetch_assoc();
                $area_id = $row['id'];
                $area->id = $row['id'];
                $area->name= $row['name'];
                
                $myJSON = json_encode($area);
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
    
    $conn->close();

?>