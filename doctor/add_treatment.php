<?php

session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'doc_project');

$new_treatment = $_POST['new_treatment'];

$s = "select * from treatment where treatment_name = '$new_treatment'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
    $_SESSION['status'] = "Treatment already found!";
    $_SESSION['status_code'] = "error";
    $_SESSION['button'] = "Oh. Okay!";
    header('location:p_treatment.php');

    
}else{
    $reg = "insert into treatment(treatment_name) values ('$new_treatment')";
    $reg_query_run = mysqli_query($con, $reg);
    if($reg_query_run){
        $_SESSION['status'] = "Treatment added Successfully";
        $_SESSION['status_code'] = "success";
        $_SESSION['button'] = "Ok. Done!";
        header('location:p_treatment.php');
    }else{
        $_SESSION['status'] = "Failed to add treatment!";
        $_SESSION['status_code'] = "error";
        $_SESSION['button'] = "Oh. Okay!";
        header('location:p_treatment.php');
    }
}


?>