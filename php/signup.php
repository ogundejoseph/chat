<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
   
    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password) && !empty($cpassword)){
        if($cpassword == $password){
            if (strlen($password) >= 8){ //if password length is atlest 8 characters 
                // let's check user email is valid or not
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    // let's check that email already exists in the database or not
                    $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
                    if(mysqli_num_rows($sql) > 0){ //if email already exist
                        echo "$email already exist!";
                    } else{               
                        $random_id = rand(time(), 100000000); //creating random id for user
                        $image_name = "profile.jpg";
                        $status = time(); //once users sign up their status will be active)
                        //let's insert all user data inside table
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                                    VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$hashed_password}', '{$image_name}', '{$status}')");
                        if($sql2){ //if data are successfully uploaded databade
                            $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                            if(mysqli_num_rows($sql3) > 0){
                                $row = mysqli_fetch_assoc($sql3);
                                $_SESSION['unique_id'] = $row['unique_id']; //using this session we used user unique_id in other php file
                                echo "success";
                            }
                        }else{
                            echo "Something went wrong! ";
                        }      
                    }
                } else{
                echo "$email is not a valid email! ";
                }
            } else{
                echo "Input password of atleast 8 characters! ";
            }
        } else{
            echo "Passwords does not match! ";
        }
    } else{
    echo "All input fields are required! ";
    }
?>