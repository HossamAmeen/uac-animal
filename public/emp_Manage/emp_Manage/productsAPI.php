<?php 
    require_once('config.php');
    
    $sql = "SELECT * FROM prochure";
    $result = $conn->query($sql);
    
    // prochure class
    $prochure= new \stdClass();
    
    if ($result->num_rows > 0) {
        // output data of each row
        $i = 1;
        echo '{"Product" :[';
        do {
            $row = $result->fetch_assoc();
            $prochure->url= $row['url'];
            $prochure->desc= $row['description'];
            $prochure -> price = $row['price'];
            $myJSON = json_encode($prochure);
            
	        if($i == $result->num_rows) {
	            echo $myJSON;
            } else {
                echo $myJSON . ',';
            }
            $i++;
        } while($i<=$result->num_rows);
        
        echo ']}';
    } else {
        echo "0 results";
    }
    $conn->close();

?>