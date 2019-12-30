<?php
    require_once('config.php');
    
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $area_id = $_POST['area'];
    $phone = $_POST['phone'];

    
    $sql = "INSERT INTO moderator (name, userName, pass, area, phone)
    VALUES ('{$name}', '{$username}', '{$password}', '{$area_id}', '{$phone}')";
    
    if ($conn->query($sql) === TRUE) {
        echo '{"success": true}';
    } else {
        echo '{"success": false}';
    }
?>