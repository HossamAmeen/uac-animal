<?php
    require_once('config.php');
    
    $postdata = file_get_contents("php://input");
    $id = json_decode($postdata);
    
    // sql to delete a record
    $sql = "DELETE FROM visit WHERE id='{$id}'";
    
    if ($conn->query($sql) === TRUE) {
        echo '{"success": true}';
    } else {
        echo '{"success": false}';
    }
    
    $conn->close();
?>