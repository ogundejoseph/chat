<?php
    while($row = mysqli_fetch_assoc($sql)){
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                 OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id}
                 OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        if(mysqli_num_rows($query2) > 0){
            $result = $row2['msg'];
        }else{
            $result = "No message available";
        }

        $status = $row['status']; 
        $active = "";
        if($status <= time() && $status >= time() - 1){
            $active = "online";
        }

        // trimming message if words are more than 28
        (strlen($result) > 35) ? $msg = substr($result, 0, 35) . '...' : $msg = $result;
        // adding you: text before msg if login id send msg
        (!empty ($row2['msg']) && $outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        //chech user is online or offline
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
        $output .= '<a href="chat.php?user_id='. $row['unique_id'] .'">
                    <div class="content">
                    <img src="php/images/profiles/'. $row['img'] .'" alt="">
                    <div class="details">
                        <span>'. $row['fname'] . " " . $row['lname'] .'</span>
                        <p>'. $you . $msg .'</p>
                    </div>                 
                    </div>
                    <div class="status-dot '.$active.'"><i class="fa fa-circle" aria-hidden="true"></i></div>
                    </a>';
    }
?>