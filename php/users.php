<?php
    session_start();
    date_default_timezone_set('Africa/Nairobi');
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id}");
    $output = "";

    if(mysqli_num_rows($sql) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($sql) > 0){
        include "data.php";
    }
    echo $output;

    $status2 = time();
    $sql3 = mysqli_query($conn, "UPDATE users SET status = {$status2} WHERE unique_id = {$outgoing_id}");
?>