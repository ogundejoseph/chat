<?php 
   $conn = mysqli_connect("hostname", "username", "password", "database");
   if(!$conn){
      echo "Error" .mysqli_connect_error();
   }
?>
