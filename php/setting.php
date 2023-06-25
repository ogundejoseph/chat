<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $fname = mysqli_real_escape_string($conn, $_POST['nfname']);
        $lname = mysqli_real_escape_string($conn, $_POST['nlname']);
        $curr_password = mysqli_real_escape_string($conn, $_POST['cpassword']);
        $new_password = mysqli_real_escape_string($conn, $_POST['npassword']);
   
        if(!empty($fname) && !empty($lname)){
            $sql = mysqli_query($conn, "UPDATE users SET fname = '{$fname}', lname = '{$lname}' WHERE unique_id = {$outgoing_id}");
            if($sql){
                echo "Successfull. ";
            }
        } else {
            if(!empty($fname) && empty($lname) || empty($fname) && !empty($lname)){
            echo "Fill both names or leave both blank! ";
            }
        }
        if(!empty($curr_password) && !empty($new_password)){
            //let's check users entered password matched to database any table row password
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$outgoing_id}");
            if(mysqli_num_rows($sql) > 0){ //if user entered password matched current password
                $row = mysqli_fetch_assoc($sql);
                $hashed_password = $row['password'];
                if(password_verify($curr_password, $hashed_password)){ //if password matched
                    $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                
                    $sql2 = mysqli_query($conn, "UPDATE users SET password = '{$new_hashed_password}' WHERE unique_id = {$outgoing_id}");
                    if($sql2){
                        echo "Successfull. ";
                    }
                } else{
                    echo "You entered wrong password! ";
                }
            }
        } else {
            if(!empty($curr_password) && empty($new_password) || empty($curr_password) && !empty($new_password)){
            echo "Fill both password or leave both blank! ";
            }
        }

        if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){ // checking if file is uploaded and the passed file is not empty and contain a valid file data 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$outgoing_id}");
            $img_name = $_FILES['image']['name']; //getting user uploaded image name         
            $tmp_name = $_FILES['image']['tmp_name']; //temporary name used to save/move file in our folder

            //get image extension
            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode); //get extension of uploaded image

            $extensions = ['png', 'PNG', 'jpeg', 'JPEG', 'jpg', 'JPG']; //valid extension
            if(in_array($img_ext, $extensions) === true){
                $curr_img = mysqli_query($conn, "SELECT img FROM users WHERE unique_id = {$outgoing_id}");
                if(mysqli_num_rows($curr_img) > 0){ //if image already exist then we delete current image before uploading new image
                    $row = mysqli_fetch_assoc($curr_img);
                    if(!empty($row['img']) && $row['img'] != "profile.jpg"){
                        $path = "images/profiles/$row[img]"; //getting current image location
                        if(file_exists($path)) { //checking if the image is still available in its location
                            unlink($path); //deleting current image
                        } else {
                            echo "Could not unlink current image! The image may have been moved or deleted. ";
                        }   
                    }
                }

                $time = time(); //this will return current time                       
                $new_img_name = $time.$img_name; //image will be saved and renamed in our folder with current time

                if(move_uploaded_file($tmp_name, "images/profiles/".$new_img_name)){ //if user upload image successfully
                    //move user uploaded image to images folder
                    //let's update image name inside table
                    $sql2 = mysqli_query($conn, "UPDATE users SET img = '{$new_img_name}' WHERE unique_id = {$outgoing_id}");
                    //$sql2 = mysqli_query($conn, "INSERT INTO users (img) VALUES ('{$new_img_name}') WHERE (unique_id = {$outgoing_id})");
                    if($sql2){ //if data are successfully uploaded databade
                        echo "Successfull. ";
                    }else{
                        echo "Something went wrong! ";
                    } 
                }       
            } else{           
                echo "Please select an image type file! ";
            }
        }
    } else{
        header("../login.php");
    }

?>