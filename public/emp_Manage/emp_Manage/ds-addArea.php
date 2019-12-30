<?php
    require_once('config.php');
    
    $name = $_POST['name'];
    
    $sql = "INSERT INTO area (name, trash)
            VALUES ('{$name}', 0)";
            
    if ($conn->query($sql) === TRUE) {
        echo '{"success": true}';
    } else {
        echo '{"success": false}';
    }
    
    $conn->close();

?>