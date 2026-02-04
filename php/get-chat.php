<?php
session_start();
include "db_conn.php";
if (isset($_SESSION['user_id'])) {
    $outgoing_id = $_SESSION['user_id'];
    $incoming_id = $_POST['incoming_id'];
    $output = "";
    $mess = "";

    $sql = "SELECT * FROM messages LEFT JOIN user_form ON user_form.uid = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = '$outgoing_id' AND incoming_msg_id = '$incoming_id')
                OR (outgoing_msg_id = '$incoming_id' AND incoming_msg_id = '$outgoing_id') ORDER BY msg_id asc";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['outgoing_msg_id'] == $outgoing_id) {
                $mess = $row['msg'];
                $img = $row['mimg'];
                if($img == 0){
                    $output .= '<div class="chat outgoing">
                       
                                <div class="details">
                                    <p>' . $mess . '</p>
                                </div>
                                <img src="images/default-avatar.png" alt="">
                                </div>';
                }
                else if($img!=0){
                    $output .= '<div class="chat outgoing">
                       
                                <div class="details" style="background: transparent; width:150px;height:260px;border-radius: 18px 18px 0 18px;">
                                    <p style="background: transparent;"><img src="php/images/'.$img.'" alt="" style="width:100%; height:250px; border-radius:0;border:none;"></p>
                                </div>
                                <img src="images/default-avatar.png" alt="">
                                </div>';
                }
            } 
            else {
                $mess = $row['msg'];
                $img = $row['mimg'];
                if($img == 0){
                    $output .= '<div class="chat incoming">
                                <img src="images/default-avatar.png" alt="">
                                <div class="details">
                                    <p>' . $mess . '</p>
                                </div>
                                </div>';
                }else if($img!= 0){
                    $output .= '<div class="chat incoming">
                                <img src="images/default-avatar.png" alt="">
                                <div class="details" style="background: transparent;width:200px;height:260px;border-radius: 18px 18px 0 18px;">
                                    <p style="background: transparent;"><img src="php/images/'.$img.'" alt="" style="width:100%; height:250px; border-radius:0;border:none;"></p>
                                </div>
                                </div>';
                }
            }
        }
    } else {
        $output .= '<div class="text">Messages are end-to-end encrypted. No one outside of this chat can read them.<br>Your messages will appear here as you start chating</div>';
    }
    echo $output;
} else {
    header("location: loginform.php");
}
