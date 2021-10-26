<?php

session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'doc_project');

$new_m = $_POST['new_medicine'];

$s = "select * from medications where medicine = '$new_m'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
    $_SESSION['status'] = "Medcine already found!";
    $_SESSION['status_code'] = "error";
    $_SESSION['button'] = "Oh. Okay!";
    header('location:medications.php');
}else{
    $reg = "insert into medications(medicine) values ('$new_m')";
    $reg_query_run = mysqli_query($con, $reg);
    if($reg_query_run){
        $_SESSION['status'] = "Medcine added Successfully";
        $_SESSION['status_code'] = "success";
        $_SESSION['button'] = "Ok. Done!";
        header('location:medications.php');
    }
}

?>