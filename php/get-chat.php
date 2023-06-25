<?php
    session_start();
    date_default_timezone_set('Africa/Nairobi');
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";

        $sql = "SELECT * FROM messages
                LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $date = $row['time'];
                $time = date("H:i",$date);
                if($row['outgoing_msg_id'] === $outgoing_id){ //if is equal to then ..is a message sender
                    $output .= '<div class="chat outgoing">
                                 <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                    <h5>'. $time .'</h5>
                                 </div>
                                 <img src="static/images/profiles/'. $row['img'] .'" alt="">
                                </div>';
                }else{ //..is a message receiver
                    $output .= '<div class="chat incoming">
                                <img src="static/images/profiles/'. $row['img'] .'" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                    <h5>'. $time .'</h5>
                                </div>
                                </div>';
                }
            }
            echo $output;
        } else{
            $output .= '<div class="no-chat">
                            <p>No messages are available. Once you start sending messages, they will appear here.</p>
                        </div>';
            echo $output;
        }
        $status = time();
        $sql2 = mysqli_query($conn, "UPDATE users SET status = {$status} WHERE unique_id = {$outgoing_id}");
    }else{
        header("../login.php");
    }
?>