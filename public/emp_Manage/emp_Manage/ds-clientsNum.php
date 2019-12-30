<?php
    require_once('config.php');
    
    $sql = "SELECT COUNT(*) as num FROM company where trash=0";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $num = $row['num'];
            
            echo json_encode($num);
        }
    } else {
        echo "0 results";
    }  
?>