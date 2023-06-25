<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){ // if user is logged in then come to this page otherwise go to login page
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        if(isset($logout_id)){ //if logout id is set
            session_unset();
            session_destroy();
            header("location: ../users.php");
        }
    } else{
        header("location: ../login.php");
    }
?>