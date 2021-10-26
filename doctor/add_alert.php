<?php

session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'doc_project');

$new_a = $_POST['new_alert'];

$s = "select * from alert where name = '$new_a'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
    $_SESSION['status'] = "Alert already found!";
    $_SESSION['status_code'] = "error";
    $_SESSION['button'] = "Oh. Okay!";
    header('location:p_alert.php');
}else{
    $reg = "insert into alert(name) values ('$new_a')";
    $reg_query_run = mysqli_query($con, $reg);
    if($reg_query_run){
        $_SESSION['status'] = "Alert added Successfully";
        $_SESSION['status_code'] = "success";
        $_SESSION['button'] = "Ok. Done!";
        header('location:p_alert.php');
    }else{
        $_SESSION['status'] = "Failed to add Alert!";
        $_SESSION['status_code'] = "error";
        $_SESSION['button'] = "Oh. Okay!";
        header('location:p_alert.php');
    }
}

?>