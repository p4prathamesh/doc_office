<?php

session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'doc_project');

$clinic_name = $_POST["clinic_name"];
// mysqli_real_escape_string($clinic_name);
$dr_name = $_POST["dr_name"];
$dr_designation = $_POST['dr_designation'];
$add1 = $_POST['add1'];
$add2 = $_POST['add2'];
$mobile = $_POST['mobile'];
$extra1 = $_POST['extra1'];
$extra2 = $_POST['extra2'];
$timing = $_POST['timing'];
$time1 = $_POST['time1'];
$time2 = $_POST['time2'];

$reg = "UPDATE header SET clinic_name='$clinic_name',dr_name='$dr_name',dr_designation='$dr_designation',add1='$add1',add2='$add2',mobile='$mobile',extra1='$extra1',extra2='$extra2',timing='$timing',time1='$time1',time2='$time2' WHERE dr_name='Dr. Mayur Kalyane' ";
// $reg = "UPDATE header SET clinic_name='$clinic_name',dr_name='$dr_name' WHERE 1 ";
$reg_query_run = mysqli_query($con, $reg);
if($reg_query_run){
    $_SESSION['status'] = "Header changed Successfully";
    $_SESSION['status_code'] = "success";
    $_SESSION['button'] = "Ok. Done!";
    header('location:p_prescription.php');
}else{
    $_SESSION['status'] = "Failed to change Header!";
    $_SESSION['status_code'] = "error";
    $_SESSION['button'] = "Oh. Okay!";
    header('location:p_prescription.php');
}


?>