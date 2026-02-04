<?php 
    session_start();
    include "db_conn.php";
    if(isset($_SESSION['user_id'])){
        $outgoing_id = $_SESSION['user_id'];
        $incoming_id = $_POST['incoming_id'];
        $filename = 0;

        if(isset($_FILES['uploadfile'])){
            $filename = $_FILES['uploadfile']['name'];
            $tempname = $_FILES['uploadfile']['tmp_name'];
            $folder = "./images/".$filename;
        }

        $message =  $_POST['message'];
        
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO `messages`(`incoming_msg_id`, `outgoing_msg_id`, `msg`, `mimg`, `status`) VALUES ('$incoming_id','$outgoing_id','$message','0','unread');") or die();
        }else if(isset($_FILES['uploadfile']) AND !empty($filename)){
            $sql = mysqli_query($conn, "INSERT INTO `messages`(`incoming_msg_id`, `outgoing_msg_id`, `msg`, `mimg`, `status`) VALUES ('$incoming_id','$outgoing_id','0','$filename','unread');") or die();
            if($sql){
                if(!file_exists($folder)){
                    move_uploaded_file($tempname , $folder);
                }
            }
        }
    }else{
        header("location: loginform.php");
    }
