<?php

session_start();
date_default_timezone_set('UTC');
$today = date("Y-m-d");

$con = mysqli_connect('localhost','root','','doc_project');

$opd_p_alert = $_SESSION["p_id"];
$alert_name = $_POST['alert_name'];

if(!$con){
    die("connection failed " . mysqli_connect_error());
}
else{
    $s = "select * from p_alert where alert = '$alert_name' and opd='$opd_p_alert'";

    $result = mysqli_query($con, $s);

    $num = mysqli_num_rows($result);
    if($num==1){
        $_SESSION['status'] = "Alert already present";
        $_SESSION['status_code'] = "error";
        $_SESSION['button'] = "Oh! Okay";
        header('location:p_alert.php');
        
    }else{
        $sql = "insert into p_alert(opd,alert) VALUES ('$opd_p_alert','$alert_name')";
        $reg_query_run = mysqli_query($con,$sql);
        if($reg_query_run){

            $_SESSION['status'] = "Alert Added Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['button'] = "Ok! Cool";
            header('location:p_alert.php');
        }
        else{
            $_SESSION['status'] = "Failed to Add Alert";
            $_SESSION['status_code'] = "error";
            $_SESSION['button'] = "Oh! Okay";
            header('location:p_alert.php');
        }   
    }
    
}


?>
