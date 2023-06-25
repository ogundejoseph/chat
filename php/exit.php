<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){ // if user is logged in then come to this page otherwise go to login page
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $exit_id = mysqli_real_escape_string($conn, $_GET['exit_id']);
        if(isset($exit_id)){ //if exit id is set
            $curr_img = mysqli_query($conn, "SELECT img FROM users WHERE unique_id = {$outgoing_id}");
            if(mysqli_num_rows($curr_img) > 0){ //checking if user uploaded image to delete before deleting account
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
            $sql = mysqli_query($conn, "DELETE FROM messages WHERE outgoing_msg_id = {$outgoing_id}"); //deleting user's chats
            $sql2 = mysqli_query($conn, "DELETE FROM users WHERE unique_id = {$outgoing_id}"); //deleting user's account
            if($sql && $sql2){
                session_unset();
                session_destroy();
                header("location: ../signup.php");
            }else{
                header("location: ../login.php");
            }
        }
    } else{
        header("location: ../login.php");
    }
?>