<?php
    session_start();
    include_once "config.php";   
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    if(!empty($email) && !empty($password)){
        //let's check users entered email & password matched to database any table row email and password
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){ //if users email matched
            $row = mysqli_fetch_assoc($sql);
            $hashed_password = $row['password'];
            if(password_verify($password, $hashed_password)){ //if password matched
                $_SESSION['unique_id'] = $row['unique_id']; //using this session we used user unique_id in other php file
                echo "success";
            }else{
                echo "Invalid password! ";
            }

        }else{
            echo "Invalid email! ";
        }
    }else{
        echo "All input fields are required! ";
    }
?>