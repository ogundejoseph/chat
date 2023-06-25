<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $curr_img = mysqli_query($conn, "SELECT img FROM users WHERE unique_id = {$outgoing_id}");

        if(mysqli_num_rows($curr_img) > 0){ //if image already exist then we delete current image before uploading new image
            $row = mysqli_fetch_assoc($curr_img);
            if(!empty($row['img']) && $row['img'] != "profile.jpg"){
                $path = "../static/images/profiles/$row[img]"; //getting current image location
                if(file_exists($path)) { //checking if the image is still available in its location
                    unlink($path); //deleting current image
                    echo "Successfull. ";
                } else {
                    echo "Could not unlink current image! The image may have been moved or deleted. ";
                }   
            }
            $new_img = "profile.jpg";
            $sql = mysqli_query($conn, "UPDATE users SET img = '{$new_img}' WHERE unique_id = {$outgoing_id}");
        }
    } else{
        header("../login.php");
    }
?>