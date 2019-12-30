<?php
    require_once('config.php');
    
    
    $target_dir = "emp_Manage/uploads/";
    
    $target_file = $target_dir . basename($_FILES["avater"]["name"]);
    $uploadOk = 1;
    $msg= '';
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    
    if($_FILES['avater']) {
        $check = getimagesize($_FILES["avater"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $msg= "File is not an image.";
            $uploadOk = 0;
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            $msg= "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["avater"]["size"] > 500000) {
            $msg= "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $msg= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["avater"]["tmp_name"], $target_file)) {
                 $name = $_POST['name'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $area_id = $_POST['area'];
                $phone = $_POST['phone'];
                $mod = $_POST['moderator'];
                
                $domain = 'http://uac-animal.com/';
                $image = $domain . $target_file;
                $avater_name = $_FILES["avater"]["name"];
                        
                $sql = "INSERT INTO employee (name, userName, password, area_id, phoneNum, mod_id, image)
                VALUES ('{$name}', '{$username}', '{$password}', '{$area_id}', '{$phone}', '{$mod}', '{$image}')";
                
                if ($conn->query($sql) === TRUE) {
                    echo '{"success": true}';
                } else {
                    echo '{"success": false, "msg":' . '"' . $msg . '"}';
                }
            } else {
                echo '{"success": false, "msg":' . '"' . $msg . '"}';
                // echo "Sorry, there was an error uploading your file.";
            }
    }
}
    
    
                
     
?>