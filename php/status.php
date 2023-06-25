<?php
    session_start();
    date_default_timezone_set('Africa/Nairobi');
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $user_id = $_COOKIE['userId'];
        $sql = mysqli_query($conn, "SELECT status FROM users WHERE unique_id = {$user_id}"); 
        if (mysqli_num_rows($sql) > 0) {
            while($row = mysqli_fetch_array($sql)){
                $status = $row['status'];
                $output = "";
                $date = date("d/m/Y,",$status);
                $month = date("jS F",$status);
                $day = date("l",$status); 
                $time = date("H:i",$status);
                if($status <= time() - (365 * 24 * 60 * 60)){
                    $output .= 'Last active '. $date .'';
                } elseif($status <= time() - (7 * 24 * 60 * 60)){
                    $output .= 'Last active '. $month . " at " . $time .'';
                } elseif($status <= time() && $status >= time() - 1){
                    $output .= 'Active now';
                } elseif($day == date("l",time())){
                    $output .= 'Last active Today at '. $time .'';
                } elseif($day == date("l",strtotime("yesterday"))){
                    $output .= 'Last active Yesterday at '. $time .'';
                } else{
                    $output .= 'Last active '. $day . " at " . $time .'';
                } 
                echo $output;  
            }
        }           
         
    } else{
        header("location: ../login.php");
    } 

?>