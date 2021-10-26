<?php

session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'doc_project');

$new_labname = $_POST['new_labname'];
$new_givenwork = $_POST['new_givenwork'];
$status = $_POST['status'];

$s = "select * from labwork where lab_name = '$new_labname' and given_work = '$new_givenwork'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
    $_SESSION['status'] = "Labwork already found!";
    $_SESSION['status_code'] = "error";
    $_SESSION['button'] = "Oh. Okay!";
    header('location:labwork.php');

    
}else{
    $reg = "insert into labwork(lab_name,given_work,status) values ('$new_labname','$new_givenwork','$status')";
    $reg_query_run = mysqli_query($con, $reg);
    if($reg_query_run){
        $_SESSION['status'] = "Labwork added Successfully";
        $_SESSION['status_code'] = "success";
        $_SESSION['button'] = "Ok. Done!";
        header('location:labwork.php');
    }else{
        $_SESSION['status'] = "Failed to add labwork!";
        $_SESSION['status_code'] = "error";
        $_SESSION['button'] = "Oh. Okay!";
        header('location:labwork.php');
    }
}


?>