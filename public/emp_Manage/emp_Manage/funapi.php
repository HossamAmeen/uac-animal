
<?php 
    require_once('config.php');
	
    $id = trim($_POST['id']);
	$year = trim($_POST['year']);
	$month = trim($_POST['month']);
	$day = trim($_POST['day']);
		
    $sql = "SELECT * FROM Tracking WHERE YEAR(date) = '{$year}' and Day(date) ='{$day}'  and Month(date) ='{$month}' and empid =".$id ;
    $result = $conn->query($sql);
    
   echo '{ "url": "https://www.google.com/maps/dir/';
    if ($result->num_rows > 0) {
        // output data of each row
		
		$i=0;
		while($i<$result->num_rows){
			
            $row = $result->fetch_assoc();
            $n = $row['lat']; 
			$m = $row['lng'];
            
			echo $n . ',' . $m . '/';
           
			$i++;
		}
		
	echo '"}';
	   
    }else {
        echo '"}';
    }
    $conn->close();

?>