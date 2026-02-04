<?php
    session_start();
    include "db_conn.php";

    $outgoing_id = $_SESSION['uid'];

    $sql = "SELECT * FROM user_form where uid in(select outgoing_msg_id from messages) order by uid asc;";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>