<?php
$mess = "";
$msg = "";
while ($row = mysqli_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = '0'
                OR outgoing_msg_id = '0') AND (outgoing_msg_id = '$outgoing_id' 
                OR incoming_msg_id = '$outgoing_id') ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    if (mysqli_num_rows($query2) > 0) {
        $img = $row['img'];
        $mess = $row2['msg'];
    } else {
        $mess = "No message available";
    }

    if (isset($row2['outgoing_msg_id'])) {
        ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
    } else {
        $you = "";
    }

    //($row['status'] == "unread") ? $offline = "offline" : $offline = "";

    if (($outgoing_id == 0)) {
        $hid_me = "hide";
    } else {
        $hid_me = "";
    };

    $output .= '<a href="admin_contactpage.php?user_id=' . $row['uid'] . '">
                    <div class="content">
                    <img src="C:/xampp/htdocs/PHP/electronicServiceProject/images/' . $img . '" alt="">
                    <div class="details">
                        <span>' . $row['name'] . '</span>
                        <p>' . $you . $mess . '</p>
                    </div>
                    </div>
                </a>';
}
