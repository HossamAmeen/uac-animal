<?php 
    require_once('config.php');
    
    $sql = "SELECT * FROM track";
    $result = $conn->query($sql);
    
   
    if ($result->num_rows > 0) {
        // output data of each row

        
            $row = $result->fetch_assoc();
            $n = $row['active'];
            
            $myJSON = json_encode($n);
			echo  $myJSON;
	   
    }
    $conn->close();

?>